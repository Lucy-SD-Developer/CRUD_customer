<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\CustomerModel;
 
class Customers extends Controller
{
 
    public function index()
    {    
        $model = new CustomerModel();
 
        $data['customers'] = $model->orderBy('id', 'DESC')->findAll();
        
        return view('customers', $data);
    }    
 
    public function create()
    {    
        return view('create-customer');
    }
 
    public function store()
    {  
 
        helper(['form', 'url']);
         
        $model = new CustomerModel();
 
        $data = [
 
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
            ];
 
        $save = $model->insert($data);
 
        return redirect()->to( base_url('public/index.php/customers') );
    }
 
    public function edit($id = null)
    {
      
     $model = new CustomerModel();
 
     $data['customer'] = $model->where('id', $id)->first();
 
     return view('public/index.php/edit-customer', $data);
    }
 
    public function update()
    {  
 
        helper(['form', 'url']);
         
        $model = new CustomerModel();
 
        $id = $this->request->getVar('id');
 
        $data = [
 
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
            ];
 
        $save = $model->update($id,$data);
 
        return redirect()->to( base_url('public/index.php/customers') );
    }
 
    public function delete($id = null)
    {
 
     $model = new CustomerModel();
 
     $data['customer'] = $model->where('id', $id)->delete();
      
     return redirect()->to( base_url('public/index.php/customers') );
    }
}