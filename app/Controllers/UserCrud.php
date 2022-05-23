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
            $userModel = new UserModal();
            $data = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email')
            ];
            $userModel->insert($data);
            return $this->response->redirect(site_url('/users-list'));     
        }
    }
?>