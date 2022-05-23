<?php 
    namespace App\Controllers;
    use App\Models\UserModel;
    use CodeIgniter\Controller;

    class UserCrud extends Controller{
        //index page
        public function index(){
            $userModel = new UserModel();
            $data['users'] = $userModel->orderBy('id', 'DESC')->findAll();
            return view('user_view', $data);
        }
        //add page
        public function create(){
            return view('user_add');
        }
        // inserting data function
        public function store(){
            $userModel = new UserModel();
            $data = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email')
            ];
            $userModel->insert($data);
            return $this->response->redirect(site_url('/users-list'));     
        }
        //display single data
        public function edit($id = null){
            $userModel = new UserModel();
            $data['user_obj'] = $userModel->where('id', $id)->first();
            return view('edit_user', $data);
        }
        //update single data
        public function update(){
            $userModel = new UserModel();
            $id = $this->request->getVar('id');
            $data = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email')
            ];
            $userModel->update($id, $data);
            return $this->response->redirect(site_url('/users-list'));
        }

        //delete single data
        public function delete($id = null){
            $userModel = new UserModel();
            $data['user'] = $userModel->where('id', $id)->delete($id);
            return $this->response->redirect(site_url('/users-list'));
        }
    }
?>