<?php
class Users
{
    // Users Properties
    public $id;
    public $phone_no;
    public $name;
    public $role;
    public $dob;
    public $gender;
    public $blood_group;
    public $nationality;
    public $caste;
    public $relogion;
    public $aadhar_no;
    public $class;
    public $distance;
    public $previous_school;
    public $image;
    public $address;
    public $s_branch;

    public $father_name;
    public $father_aadhar_no;
    public $father_edu;
    public $father_occupation;
    public $father_annual_income;
    public $mother_name;
    public $mother_aadhar_no;
    public $mother_edu;
    public $mother_occupation;
    public $mother_annual_income;

    public $teacher_name;
    public $teacher_dob;
    public $teacher_gender;
    public $subjects_offered;
    public $qualifications;

    // public $status;

    // DB stuff
    private $conn;
    private $user_table = "users";
    private $stu_table = "students_info";
    private $stu_fam_table = "students_family_info";
    private $teacher_table = "teacher_table";
    private $new_admidssion_table = "new_admission"; //new


    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Create User
    public function create()
    {
        $query = 'INSERT INTO ' . $this->user_table . ' SET
        phone_no = :phone_no,
        name = :name,
        role = :role';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind data
        $stmt->bindParam(':phone_no', $this->phone_no);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':role', $this->role);
        // $stmt->bindParam(':account', $this->status);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Check if User Exist or not
    public function check_user()
    {
        $query = 'SELECT phone_no FROM ' . $this->user_table . ' WHERE phone_no = :phone_no';

        // Prepared Statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':phone_no', $this->phone_no);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    //login of User
    public function login()
    {
        $query = 'SELECT * FROM ' . $this->user_table . ' WHERE phone_no = :phone_no';

        // Prepared Statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':phone_no', $this->phone_no);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Create Student's details
    public function create_details()
    {
        $query = 'INSERT INTO ' . $this->stu_table . ' SET
        name = :name,
        dob = :dob,
        gender = :gender,
        blood_group = :blood_group,
        nationality = :nationality,
        caste = :caste,
        relogion = :relogion,
        phone_no = :phone_no,
        aadhar_no = :aadhar_no,
        class = :class,
        distance = :distance,
        previous_school = :previous_school,
        image = :image,
        address = :address,
        s_branch = :s_branch';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Claen data
        // $this->name = htmlspecialchars(strip_tags($this->title));
        // $this->body = htmlspecialchars(strip_tags($this->body));
        // $this->author = htmlspecialchars(strip_tags($this->author));
        // $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        // $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':dob', $this->dob);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':blood_group', $this->blood_group);
        $stmt->bindParam(':nationality', $this->nationality);
        $stmt->bindParam(':caste', $this->caste);
        $stmt->bindParam(':relogion', $this->relogion);
        $stmt->bindParam(':phone_no', $this->phone_no);
        $stmt->bindParam(':aadhar_no', $this->aadhar_no);
        $stmt->bindParam(':class', $this->class);
        $stmt->bindParam(':distance', $this->distance);
        $stmt->bindParam(':previous_school', $this->previous_school);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':s_branch', $this->s_branch);



        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Check if User already Exist or not in STUDENT INFO table
    public function check_student()
    {
        $query = 'SELECT * FROM ' . $this->stu_table . ' WHERE phone_no = :phone_no OR aadhar_no = :aadhar_no';

        // Prepared Statement
        $stmt = $this->conn->prepare($query);

        $this->phone_no = htmlspecialchars(strip_tags($this->phone_no));

        $stmt->bindParam(':phone_no', $this->phone_no);
        $stmt->bindParam(':aadhar_no', $this->aadhar_no);

        // Execute query
        $stmt->execute();

        return $stmt;
    }


    // Create Student's family details
    public function create_family_info()
    {
        $query = 'INSERT INTO ' . $this->stu_fam_table . ' SET
        phone_no = :phone_no,
        father_name = :father_name,
        father_aadhar_no = :father_aadhar_no,
        father_edu_qualification = :father_edu,
        father_occupation = :father_occupation,
        father_annual_income = :father_annual_income,
        mother_name = :mother_name,
        mother_aadhar_no = :mother_aadhar_no,
        mother_edu_qualification = :motherr_edu,
        mother_occupation = :mother_occupation,
        mother_annual_income = :mother_annual_income';

        // Prepared Statement
        $stmt = $this->conn->prepare($query);

        // Claen data
        $this->phone_no = htmlspecialchars(strip_tags($this->phone_no));
        $this->father_name = htmlspecialchars(strip_tags($this->father_name));
        $this->father_aadhar_no = htmlspecialchars(strip_tags($this->father_aadhar_no));
        $this->father_edu = htmlspecialchars(strip_tags($this->father_edu));
        $this->father_occupation = htmlspecialchars(strip_tags($this->father_occupation));
        $this->father_annual_income = htmlspecialchars(strip_tags($this->father_annual_income));
        $this->mother_name = htmlspecialchars(strip_tags($this->mother_name));
        $this->mother_aadhar_no = htmlspecialchars(strip_tags($this->mother_aadhar_no));
        $this->mother_edu = htmlspecialchars(strip_tags($this->mother_edu));
        $this->mother_occupation = htmlspecialchars(strip_tags($this->mother_occupation));
        $this->mother_annual_income = htmlspecialchars(strip_tags($this->mother_annual_income));


        // Bind data
        $stmt->bindParam(':phone_no', $this->phone_no);
        $stmt->bindParam(':father_name', $this->father_name);
        $stmt->bindParam(':father_aadhar_no', $this->father_aadhar_no);
        $stmt->bindParam(':father_edu', $this->father_edu);
        $stmt->bindParam(':father_occupation', $this->father_occupation);
        $stmt->bindParam(':father_annual_income', $this->father_annual_income);
        $stmt->bindParam(':mother_name', $this->mother_name);
        $stmt->bindParam(':mother_aadhar_no', $this->mother_aadhar_no);
        $stmt->bindParam(':motherr_edu', $this->mother_edu);
        $stmt->bindParam(':mother_occupation', $this->mother_occupation);
        $stmt->bindParam(':mother_annual_income', $this->mother_annual_income);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Check if User already Exist or not in STUDENT FAMILY INFO table
    public function check_student_fam_info()
    {
        $query = 'SELECT * FROM ' . $this->stu_fam_table . ' WHERE
        phone_no = :phone_no OR
        father_aadhar_no = :father_aadhar_no OR
        mother_aadhar_no = :mother_aadhar_no';

        // Prepared Statement
        $stmt = $this->conn->prepare($query);

        // $this->phone_no = htmlspecialchars(strip_tags($this->phone_no));
        // $this->father_aadhar_no = htmlspecialchars(strip_tags($this->father_aadhar_no));
        // $this->mother_aadhar_no = htmlspecialchars(strip_tags($this->mother_aadhar_no));

        $stmt->bindParam(':phone_no', $this->phone_no);
        $stmt->bindParam(':father_aadhar_no', $this->father_aadhar_no);
        $stmt->bindParam(':mother_aadhar_no', $this->mother_aadhar_no);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Add Teacher's details
    public function add_teacher_info()
    {
        $query = 'INSERT INTO ' . $this->teacher_table . ' SET
            phone_no = :phone_no,
            name = :name,
            dob = :dob,
            gender = :gender,
            subjects_offered = :subjects_offered,
            qualifications = :qualifications,
            image = :image';

        // Prepared Statement
        $stmt = $this->conn->prepare($query);

        // Claen data
        $this->phone_no = htmlspecialchars(strip_tags($this->phone_no));
        $this->teacher_name = htmlspecialchars(strip_tags($this->teacher_name));
        $this->teacher_dob = htmlspecialchars(strip_tags($this->teacher_dob));
        $this->teacher_gender = htmlspecialchars(strip_tags($this->teacher_gender));
        $this->subjects_offered = htmlspecialchars(strip_tags($this->subjects_offered));
        $this->qualifications = htmlspecialchars(strip_tags($this->qualifications));
        $this->image = htmlspecialchars(strip_tags($this->image));

        // Bind data
        $stmt->bindParam(':phone_no', $this->phone_no);
        $stmt->bindParam(':name', $this->teacher_name);
        $stmt->bindParam(':dob', $this->teacher_dob);
        $stmt->bindParam(':gender', $this->teacher_gender);
        $stmt->bindParam(':subjects_offered', $this->subjects_offered);
        $stmt->bindParam(':qualifications', $this->qualifications);
        $stmt->bindParam(':image', $this->image);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Check if User already Exist or not in TEACHER TABLE 
    public function check_teacher_info()
    {
        $query = 'SELECT * FROM ' . $this->teacher_table . ' WHERE phone_no = :phone_no';

        // Prepared Statement
        $stmt = $this->conn->prepare($query);

        $this->phone_no = htmlspecialchars(strip_tags($this->phone_no));

        $stmt->bindParam(':phone_no', $this->phone_no);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // get student (single) by their jwt
    public function get_student()
    {
        // Create query
        $query = 'SELECT 
                    p.name as student_name,
                    p.dob,
                    p.gender,
                    p.blood_group,
                    p.phone_no,
                    p.class,
                    p.image,
                    p.address,
                    c.father_name,
                    c.mother_name
                FROM
                    ' . $this->stu_table . ' p
                    LEFT JOIN
                    ' . $this->stu_fam_table . ' c ON p.phone_no = c.phone_no
                    WHERE
                    p.phone_no = :phone_no
                    LIMIT 0,1';

        // Prepared Statement
        $stmt = $this->conn->prepare($query);

        $this->phone_no = htmlspecialchars(strip_tags($this->phone_no));

        $stmt->bindParam(':phone_no', $this->phone_no);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // get teacher (single) by their jwt
    public function get_teacher()
    {
        // Create query
        $query = 'SELECT * FROM ' . $this->teacher_table . ' WHERE phone_no = :phone_no';

        // Prepared Statement
        $stmt = $this->conn->prepare($query);

        $this->phone_no = htmlspecialchars(strip_tags($this->phone_no));

        $stmt->bindParam(':phone_no', $this->phone_no);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // get all student by admin,principal,teacher
    public function get_all_students()
    {
        // Create query
        $query = 'SELECT 
                    p.name as student_name,
                    p.dob,
                    p.gender,
                    p.blood_group,
                    p.phone_no,
                    p.class,
                    p.image,
                    p.address,
                    p.s_branch,
                    p.previous_school,
                    c.father_name,
                    c.mother_name,
                    c.father_occupation,
                    c.mother_occupation
                FROM
                    ' . $this->stu_table . ' p
                    LEFT JOIN
                    ' . $this->stu_fam_table . ' c ON p.phone_no = c.phone_no
                    ORDER BY 
                    p.class';

        // Prepared Statement
        $stmt = $this->conn->prepare($query);

        $this->phone_no = htmlspecialchars(strip_tags($this->phone_no));

        $stmt->bindParam(':phone_no', $this->phone_no);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // get teacher by admin and principal
    public function get_all_teachers()
    {
        // Create query
        $query = 'SELECT 
                    p.name as teacher_name,
                    p.phone_no,
                    c.role,
                    c.account,
                    p.dob,
                    p.gender,
                    p.subjects_offered,
                    p.qualifications,
                    p.image
                FROM
                    ' . $this->teacher_table . ' p
                    LEFT JOIN
                    ' . $this->user_table . ' c ON p.phone_no = c.phone_no
                    ORDER BY 
                    c.created_at';

        // Prepared Statement
        $stmt = $this->conn->prepare($query);

        // $this->phone_no = htmlspecialchars(strip_tags($this->phone_no));

        // $stmt->bindParam(':phone_no', $this->phone_no);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
    
    // add student into new admission (temporary)
    public function new_admission()
    {
        $query = 'INSERT INTO ' . $this->new_admidssion_table . ' SET
        phone_no = :phone_no,
        name = :name,
        dob = :dob,
        gender = :gender,
        blood_group = :blood_group,
        nationality = :nationality,
        caste = :caste,
        religion = :relogion,
        aadhar_no = :aadhar_no,
        class = :class,
        distance = :distance,
        previous_school = :previous_school,
        image = :image,
        address = :address,
        s_branch = :s_branch,
        father_name = :father_name,
        father_aadhar_no = :father_aadhar_no,
        father_edu_qualification = :father_edu,
        father_occupation = :father_occupation,
        father_annual_income = :father_annual_income,
        mother_name = :mother_name,
        mother_aadhar_no = :mother_aadhar_no,
        mother_edu_qualification = :motherr_edu,
        mother_occupation = :mother_occupation,
        mother_annual_income = :mother_annual_income';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Claen data
        // $this->name = htmlspecialchars(strip_tags($this->title));
        // $this->body = htmlspecialchars(strip_tags($this->body));
        // $this->author = htmlspecialchars(strip_tags($this->author));
        // $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        // $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':phone_no', $this->phone_no);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':dob', $this->dob);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':blood_group', $this->blood_group);
        $stmt->bindParam(':nationality', $this->nationality);
        $stmt->bindParam(':caste', $this->caste);
        $stmt->bindParam(':relogion', $this->relogion);
        $stmt->bindParam(':aadhar_no', $this->aadhar_no);
        $stmt->bindParam(':class', $this->class);
        $stmt->bindParam(':distance', $this->distance);
        $stmt->bindParam(':previous_school', $this->previous_school);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':s_branch', $this->s_branch);
        $stmt->bindParam(':father_name', $this->father_name);
        $stmt->bindParam(':father_aadhar_no', $this->father_aadhar_no);
        $stmt->bindParam(':father_edu', $this->father_edu);
        $stmt->bindParam(':father_occupation', $this->father_occupation);
        $stmt->bindParam(':father_annual_income', $this->father_annual_income);
        $stmt->bindParam(':mother_name', $this->mother_name);
        $stmt->bindParam(':mother_aadhar_no', $this->mother_aadhar_no);
        $stmt->bindParam(':motherr_edu', $this->mother_edu);
        $stmt->bindParam(':mother_occupation', $this->mother_occupation);
        $stmt->bindParam(':mother_annual_income', $this->mother_annual_income);



        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
    
    //get admission requests from new_admission_table
    public function admission_requests()
    {
        $query = 'SELECT * FROM ' . $this->new_admidssion_table . ' ORDER BY id';

        // Prepared Statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
}
