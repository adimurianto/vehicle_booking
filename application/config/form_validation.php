<?php
$config = array(
    'admin_users' => array(
      array(
        'field' => 'name',
        'label' => 'Nama',
        'rules' => 'required|trim'
      ),
      array(
        'field' => 'phonenumber',
        'label' => 'No Telp',
        'rules' => 'required|trim|numeric'
      ),
      array(
        'field' => 'gender',
        'label' => 'Jenis Kelamin',
        'rules' => 'required|trim'
      ),
      array(
        'field' => 'email',
        'label' => 'Email',
        'rules' => 'required|trim|valid_email'
      ),
      array(
        'field' => 'password',
        'label' => 'Kata sandi',
        'rules' => 'trim'
      ),
      array(
        'field' => 'address',
        'label' => 'Alamat',
        'rules' => 'required|trim'
      ),
      array(
        'field' => 'level',
        'label' => 'Akses Level',
        'rules' => 'required|trim'
      ),
      array(
        'field' => 'status',
        'label' => 'Status',
        'rules' => 'required|trim'
      ),
    ),
    'admin_menu' => array(
      array(
        'field' => 'name',
        'label' => 'Nama Menu',
        'rules' => 'required|trim'
      ),
      array(
        'field' => 'url',
        'label' => 'Link Menu',
        'rules' => 'required|trim'
      ),
      array(
        'field' => 'sort',
        'label' => 'Sort Menu',
        'rules' => 'required|trim'
      ),
      array(
        'field' => 'level',
        'label' => 'Level Menu',
        'rules' => 'required|trim'
      )
    ),
    'admin_group' => array(
      array(
        'field' => 'name',
        'label' => 'Nama Grup',
        'rules' => 'required|trim'
      )
    ),
    'admin_login' => array(
      array(
        'field' => 'login_email',
        'label' => 'Email',
        'rules' => 'required|trim|valid_email'
      ),
      array(
        'field' => 'login_password',
        'label' => 'Kata sandi',
        'rules' => 'required|trim'
      )
    ),
    'users_update' => array(
      array(
        'field' => 'name_account',
        'label' => 'Nama',
        'rules' => 'required|trim'
      ),
      array(
        'field' => 'phonenumber_account',
        'label' => 'No Telp',
        'rules' => 'required|trim|numeric'
      ),
      array(
        'field' => 'gender_account',
        'label' => 'Jenis Kelamin',
        'rules' => 'required|trim'
      ),
      array(
        'field' => 'address_account',
        'label' => 'Alamat',
        'rules' => 'required|trim'
      ),
    ),
    'drivers' => array(
      array(
        'field' => 'name',
        'label' => 'Nama',
        'rules' => 'required|trim'
      ),
      array(
        'field' => 'phone',
        'label' => 'No Telp',
        'rules' => 'required|trim|numeric'
      ),
      array(
        'field' => 'status',
        'label' => 'Status',
        'rules' => 'required|trim'
      ),
    ),
    'vehicles' => array(
      array(
        'field' => 'plate_number',
        'label' => 'Nomor Plat',
        'rules' => 'required|trim'
      ),
      array(
        'field' => 'type',
        'label' => 'Jenis Angkutan',
        'rules' => 'required|trim'
      ),
      array(
        'field' => 'ownership',
        'label' => 'Pemilik Kendaraan', 
        'rules' => 'required|trim'  
      ),
      array(
        'field' => 'location_id',
        'label' => 'Lokasi',
        'rules' => 'required|trim'  
      ),
      array(
        'field' => 'status',
        'label' => 'Status',
        'rules' => 'required|trim'
      ),
    ),
    'booking' => array(
      array(
        'field' => 'vehicle_id',
        'label' => 'Kendaraan',
        'rules' => 'required|trim'
      ),
      array(
        'field' => 'driver_id',
        'label' => 'Driver',
        'rules' => 'required|trim'
      ),
      array(
        'field' => 'requester_name',
        'label' => 'Nama Pemesan',
        'rules' => 'required|trim'
      ),
      array(
        'field' => 'purpose',
        'label' => 'Keterangan',
        'rules' => 'required|trim'
      ),
      array(
        'field' => 'start_date',
        'label' => 'Tanggal Mulai',
        'rules' => 'required|trim'
      ),
      array(
        'field' => 'end_date',
        'label' => 'Tanggal Akhir',
        'rules' => 'required|trim'
      ),
    ),
);