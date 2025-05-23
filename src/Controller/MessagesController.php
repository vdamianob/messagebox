<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Messages Controller
 *
 * @property \App\Model\Table\MessagesTable $Messages
 * @method \App\Model\Entity\Message[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MessagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        // $this->paginate = [
        //     // 'contain' => ['Users', 'Messages'],
        //     'contain' => ['Sender', 'Receiver', 'ParentMessage'],
        // ];
        // $messages = $this->paginate($this->Messages);
        
        $userId = $this->request->getAttribute("identity")->id;
        $query = $this->Messages
            ->find('search', ['search' => $this->request->getQueryParams(), 'userId' => $userId])
            ->contain(['Sender', 'Receiver'])
            ->where([
                'OR' => [
                    'Messages.sender_id' => $userId,
                    'Messages.receiver_id' => $userId,
                ]
            ])
            ->order(['Messages.created' => 'DESC']);
    
        $messages = $this->paginate($query);
    
        // inserisce il suffisso (Me) affianco all'username (sender/receiver) se è l'utente della sessione corrente
        foreach ($messages as $message) {
            $this->addMe($userId, $message);
            //print_r($message->sender->username);
        }

        $radiochoise = $this->request->getQuery('filtratipo');
        
        $this->set(compact('messages','radiochoise'));
    }

    /**
     * View method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $message = $this->Messages->get($id, [
            'contain' => ['Sender', 'Receiver', 'ParentMessage'],
        ]);
        $this->Authorization->authorize($message);

        // imposta il messaggio tra i letti
        if ($message->receiver_id === $this->request->getAttribute("identity")->id && !$message->read) {
            $message->read = true;
            $this->Messages->save($message);
        }

        $this->set(compact('message'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $message = $this->Messages->newEmptyEntity();
        $this->Authorization->skipAuthorization();
        // if ($this->request->is('post')) {
        //     $message = $this->Messages->patchEntity($message, $this->request->getData());
        //     if ($this->Messages->save($message)) {
        //         $this->Flash->success(__('The message has been saved.'));

        //         return $this->redirect(['action' => 'index']);
        //     }
        //     $this->Flash->error(__('The message could not be saved. Please, try again.'));
        // }
        // $users = $this->Messages->Sender->find('list', ['limit' => 200])->all();
        // $users = $this->Messages->Receiver->find('list', ['limit' => 200])->all();
        // $messages = $this->Messages->ParentMessage->find('list', ['limit' => 200])->all();
        // $this->set(compact('message', 'users', 'messages'));


        if ($this->request->is('post')) {
            $data = $this->request->getData() + [
                'sender_id' => $this->request->getAttribute('identity')->id,
            ];

            // inserimento id del destinatario
            if (!empty($data['receiver_username'])) {
                $this->loadModel('Users');
    
                $receiver = $this->Users->find()
                    ->where(['username' => $data['receiver_username']])
                    ->first();
    
                if ($receiver) {
                    $data['receiver_id'] = $receiver->id;
                } else {
                    $this->Flash->error(__('Receiver username not found.'));
                    return $this->redirect($this->referer());
                }
            } else {
                $this->Flash->error(__('Empty username.'));
                return $this->redirect($this->referer());
            }

            $message = $this->Messages->patchEntity($message, $data);
            //debug($message->getErrors());
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('The message has been sent.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The message could not be sent. Please, try again.'));
        }
        $this->set(compact('message'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $message = $this->Messages->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $message = $this->Messages->patchEntity($message, $this->request->getData());
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('The message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The message could not be saved. Please, try again.'));
        }
        $users = $this->Messages->Users->find('list', ['limit' => 200])->all();
        $messages = $this->Messages->Messages->find('list', ['limit' => 200])->all();
        $this->set(compact('message', 'users', 'messages'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $message = $this->Messages->get($id);
        if ($this->Messages->delete($message)) {
            $this->Flash->success(__('The message has been deleted.'));
        } else {
            $this->Flash->error(__('The message could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

        private function addMe($userId, $message) 
    {
        if ($message->sender_id == $userId && isset($message->sender->username)) {
            $message->sender->username .= ' (Me)';
        }
        if ($message->receiver_id == $userId && isset($message->receiver->username)) {
            $message->receiver->username .= ' (Me)';
        }
        return $message;
    }
}
