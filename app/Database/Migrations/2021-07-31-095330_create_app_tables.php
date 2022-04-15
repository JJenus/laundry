<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAppTables extends Migration
{
    public function up()
    {  
      
        $this->forge->addField([
          'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
          'action'           => ['type' => 'varchar', 'constraint' => 20],
          'type'             => ['type' => 'varchar', 'constraint' => 20, 'default' => "cor3"],
          'status'           => ['type' => 'tinyint'],
          'description'      => ['type' => 'text'],
          'created_at'       => ['type' => 'datetime', 'null' => true],
          'updated_at'       => ['type' => 'datetime', 'null' => true],
          'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey("id", true);
        $this->forge->createTable("setup", true);
        
        /*
         * Users
         */
        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'            => ['type' => 'text'],
            'email'            => ['type' => 'varchar', 'constraint' => 255],
            'username'         => ['type' => 'varchar', 'constraint' => 30, 'null' => true],
            'password_hash'    => ['type' => 'varchar', 'constraint' => 255],
            'reset_hash'       => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'reset_at'         => ['type' => 'datetime', 'null' => true],
            'reset_expires'    => ['type' => 'datetime', 'null' => true],
            'activate_hash'    => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'status'           => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'status_message'   => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'active'           => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
            'force_pass_reset' => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('email');
        $this->forge->addUniqueKey('username');

        $this->forge->createTable('users', true);

        /*
         * Auth Login Attempts
         */
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'ip_address' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'email'      => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'user_id'    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true], // Only for successful logins
            'date'       => ['type' => 'datetime'],
            'success'    => ['type' => 'tinyint', 'constraint' => 1],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('email');
        $this->forge->addKey('user_id');
        // NOTE: Do NOT delete the user_id or email when the user is deleted for security audits
        $this->forge->createTable('auth_logins', true);

        /*
         * Auth Tokens
         * @see https://paragonie.com/blog/2015/04/secure-authentication-php-with-long-term-persistence
         */
        $this->forge->addField([
            'id'              => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'selector'        => ['type' => 'varchar', 'constraint' => 255],
            'hashedValidator' => ['type' => 'varchar', 'constraint' => 255],
            'user_id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'expires'         => ['type' => 'datetime'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('selector');
        $this->forge->addForeignKey('user_id', 'users', 'id', false, 'CASCADE');
        $this->forge->createTable('auth_tokens', true);

        /*
         * Password Reset Table
         */
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'email'      => ['type' => 'varchar', 'constraint' => 255],
            'ip_address' => ['type' => 'varchar', 'constraint' => 255],
            'user_agent' => ['type' => 'varchar', 'constraint' => 255],
            'token'      => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => false],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('auth_reset_attempts');

        /*
         * Activation Attempts Table
         */
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'ip_address' => ['type' => 'varchar', 'constraint' => 255],
            'user_agent' => ['type' => 'varchar', 'constraint' => 255],
            'token'      => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => false],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('auth_activation_attempts');

        /*
         * Groups Table
         */
        $fields = [
            'id'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'        => ['type' => 'varchar', 'constraint' => 255],
            'description' => ['type' => 'varchar', 'constraint' => 255],
        ];

        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->createTable('auth_groups', true);

        /*
         * Permissions Table
         */
        $fields = [
            'id'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'        => ['type' => 'varchar', 'constraint' => 255],
            'description' => ['type' => 'varchar', 'constraint' => 255],
        ];

        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->createTable('auth_permissions', true);

        /*
         * Groups/Permissions Table
         */
        $fields = [
            'group_id'      => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'permission_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
        ];

        $this->forge->addField($fields);
        $this->forge->addKey(['group_id', 'permission_id']);
        $this->forge->addForeignKey('group_id', 'auth_groups', 'id', false, 'CASCADE');
        $this->forge->addForeignKey('permission_id', 'auth_permissions', 'id', false, 'CASCADE');
        $this->forge->createTable('auth_groups_permissions', true);

        /*
         * Users/Groups Table
         */
        $fields = [
            'group_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'user_id'  => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
        ];

        $this->forge->addField($fields);
        $this->forge->addKey(['group_id', 'user_id']);
        $this->forge->addForeignKey('group_id', 'auth_groups', 'id', false, 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', false, 'CASCADE');
        $this->forge->createTable('auth_groups_users', true);

        /*
         * Users/Permissions Table
         */
        $fields = [
            'user_id'       => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'permission_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
        ];

        $this->forge->addField($fields);
        $this->forge->addKey(['user_id', 'permission_id']);
        $this->forge->addForeignKey('user_id', 'users', 'id', false, 'CASCADE');
        $this->forge->addForeignKey('permission_id', 'auth_permissions', 'id', false, 'CASCADE');
        $this->forge->createTable('auth_users_permissions');
        
        /*
         * Employees
         */
        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'          => ['type' => 'int', 'constraint' => 11],
            'gender'           => ['type' => 'varchar', 'constraint' => 10, 'null' => false],
            'phone'           => ['type' => 'varchar', 'constraint' => 30, 'null' => false],
            'address'          => ['type' => 'varchar', 'constraint' => 60, 'null' => false],
            'city'          => ['type' => 'varchar', 'constraint' => 60, 'null' => false],
            'bank'          => ['type' => 'varchar', 'constraint' => 60, 'null' => false],
            'account_name'          => ['type' => 'varchar', 'constraint' => 60, 'null' => false],
            'account_number'          => ['type' => 'varchar', 'constraint' => 60, 'null' => false],
            'image_url'        => ['type' => 'text', 'default'],
            'salary'           => ['type' => 'varchar', 'constraint' => 60, 'null' => true],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', false, 'CASCADE');
        $this->forge->createTable('employees', true);
         
         
        /*
         * CUSTOMERS 
         */
        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'created_by'            => ['type' => 'int', 'constraint' => 11],
            'name'         => ['type' => 'text'],
            'type'      => ['type' => 'varchar', 'constraint' => 30, 'null' => false],
            'phone_number'           => ['type' => 'varchar', 'constraint' => 20],
            'status'           => ['type' => 'varchar', 'constraint' => 11, 'null' => true],
            'total_cost'      => ['type' => 'varchar', 'constraint' => 60, 'null' => false],
            'amount_paid'      => ['type' => 'varchar', 'constraint' => 60, 'null' => false],
            'credit'      => ['type' => 'varchar', 'constraint' => 60, 'null' => true],
            'debt'      => ['type' => 'varchar', 'constraint' => 60, 'null' => true],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('created_by', 'users', 'id', false, 'CASCADE');
        $this->forge->createTable('customers', true);
        
        
        /**
         * CLOTHE_TYPES 
         */
        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'             => ['type' => 'text'],
            'cost'             => ['type' => 'varchar', 'constraint' => 30],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('clothe_types', true);
        
        /**
         *  CLOTHES //update drop tables
         */
        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'customer_id'      => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'actions'          => ['type' => 'text'],
            'type'             => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'status'           => ['type' => 'varchar', 'constraint' => 15, "default" => "pending"],
            'washer'           => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'ironer'           => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'confirmed_by'     => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'dispensed_by'     => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('customer_id', 'customers', 'id', false, 'CASCADE');
        $this->forge->addForeignKey('type', 'clothe_types', 'id', false, 'CASCADE');
        $this->forge->addForeignKey('washer', 'users', 'id', false, 'CASCADE');
        $this->forge->addForeignKey('ironer', 'users', 'id', false, 'CASCADE');
        $this->forge->addForeignKey('confirmed_by', 'users', 'id', false, 'CASCADE');
        $this->forge->addForeignKey('dispensed_by', 'users', 'id', false, 'CASCADE');
        $this->forge->createTable('clothes', true);
        
        /**
         * CLOTHE_ACTIVITIES 
         */
        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'clothe_id'             => ['type' => 'text'],
            'washed_at'       => ['type' => 'datetime', 'null' => true],
            'ironed_at'       => ['type' => 'datetime', 'null' => true],
            'ready_at'       => ['type' => 'datetime', 'null' => true],
            'dispensed_at'       => ['type' => 'datetime', 'null' => true],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('clothe_id', 'clothes', 'id', false, 'CASCADE');
        $this->forge->createTable('clothe_activities', true);
        
        
        /**
         * ISSUES 
         */
        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'customer_id'        => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'clothe_id'        => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'title'      => ['type' => 'text',],
            'description'      => ['type' => 'text',],
            'resolved_by'       => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'created_by'       => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'resolved_at'       => ['type' => 'datetime', 'null' => true],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('clothe_id', 'clothes', 'id', false, 'CASCADE');
        $this->forge->createTable('issues', true);
        
        
        /**
         * EXPENSES 
        */
        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'employee_id'      => ['type' => 'text'],
            'name'             => ['type' => 'varchar', 'constraint' => 30],
            'description'      => ['type' => 'text', 'null' => true],
            'cost'             => ['type' => 'varchar', 'constraint' => 60],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('employee_id', 'users', 'id', false, 'CASCADE');
        $this->forge->createTable('expenses', true);
    }

    //--------------------------------------------------------------------

    public function down()
    {
		// drop constraints first to prevent errors
        if ($this->db->DBDriver != 'SQLite3')
        {
            $this->forge->dropForeignKey('auth_tokens', 'auth_tokens_user_id_foreign');
            $this->forge->dropForeignKey('auth_groups_permissions', 'auth_groups_permissions_group_id_foreign');
            $this->forge->dropForeignKey('auth_groups_permissions', 'auth_groups_permissions_permission_id_foreign');
            $this->forge->dropForeignKey('auth_groups_users', 'auth_groups_users_group_id_foreign');
            $this->forge->dropForeignKey('auth_groups_users', 'auth_groups_users_user_id_foreign');
            $this->forge->dropForeignKey('auth_users_permissions', 'auth_users_permissions_user_id_foreign');
            $this->forge->dropForeignKey('auth_users_permissions', 'auth_users_permissions_permission_id_foreign');
            
            /*
              App tables
            */
            $this->forge->dropForeignKey('employees', 'employees_user_id_foreign');
            $this->forge->dropForeignKey('customers', 'customers_created_by_foreign');
            $this->forge->dropForeignKey('clothes', 'clothes_customer_id_foreign');
            $this->forge->dropForeignKey('clothes', 'clothes_type_foreign');
            $this->forge->dropForeignKey('clothes', 'clothes_dispensed_by_foreign');
            $this->forge->dropForeignKey('clothes', 'clothes_confirmed_by_foreign');
            $this->forge->dropForeignKey('clothes', 'clothes_ironer_foreign');
            $this->forge->dropForeignKey('clothes', 'clothes_washer_foreign');
            $this->forge->dropForeignKey('clothe_activities', 'clothe_activities_employee_id_foreign');
            $this->forge->dropForeignKey('issues', 'issues_clothe_id_foreign');
            $this->forge->dropForeignKey('expenses', 'expenses_employee_id_foreign');
        }

  		$this->forge->dropTable('setup', true);
  		$this->forge->dropTable('users', true);
  		$this->forge->dropTable('auth_logins', true);
  		$this->forge->dropTable('auth_tokens', true);
  		$this->forge->dropTable('auth_reset_attempts', true);
      $this->forge->dropTable('auth_activation_attempts', true);
  		$this->forge->dropTable('auth_groups', true);
  		$this->forge->dropTable('auth_permissions', true);
  		$this->forge->dropTable('auth_groups_permissions', true);
  		$this->forge->dropTable('auth_groups_users', true);
  		$this->forge->dropTable('auth_users_permissions', true);
  		
  		$this->forge->dropTable('employees', true);
  		$this->forge->dropTable('customers', true);
  		$this->forge->dropTable('clothe_types', true);
  		$this->forge->dropTable('clothes', true);
  		$this->forge->dropTable('clothe_activities', true);
  		$this->forge->dropTable('issues', true);
  		$this->forge->dropTable('expenses', true);
    }
}
