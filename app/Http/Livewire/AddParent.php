<?php

namespace App\Http\Livewire;

use App\Models\BloodType;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\ParentAttachment;
use App\Models\Religion;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddParent extends Component
{
    use WithFileUploads;
    public $photos=[];
    public $images=[];
    public $showTable=true;
    public $currentStep=1,
    $updateMode=false,
    $parent_id,
    $successMessage="",
    $Email, $Password,
    $Name_Father, $Name_Father_en,
    $National_ID_Father, $Passport_ID_Father,
    $Phone_Father, $Job_Father, $Job_Father_en,
    $Nationality_Father_id, $Blood_Type_Father_id,
    $Address_Father, $Religion_Father_id,

     // Mother_INPUTS
     $Name_Mother, $Name_Mother_en,
     $National_ID_Mother, $Passport_ID_Mother,
     $Phone_Mother, $Job_Mother, $Job_Mother_en,
     $Nationality_Mother_id, $Blood_Type_Mother_id,
     $Address_Mother, $Religion_Mother_id;    
     public function updated($propertyName)
     {
        // real-time validation
         $this->validateOnly($propertyName,[
            'Email' => 'required|email',
            'National_ID_Father' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Father' => 'min:10|max:10',
            'Phone_Father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'National_ID_Mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Mother' => 'min:10|max:10',
            'Phone_Mother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'

         ]);
     }

    public function render()
    {
        $Type_Bloods=BloodType::all();
        $Nationalities=Nationality::all();
        $Religions=Religion::all();
        $my_parents=MyParent::all();
        return view('livewire.add-parent',compact('Type_Bloods','Nationalities','Religions','my_parents'));
    }

    public function firstStepSubmit(){
        $this->validate([
            'Email' => 'required|unique:my_parents,email,'.$this->id,
            'Password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|unique:my_parents,father_national_id,' . $this->id,
            'Passport_ID_Father' => 'required|unique:my_parents,father_passport_id,' . $this->id,
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ]);
        $this->currentStep=2;
    }

    public function firstStepSubmit_edit(){
        $this->updateMode = true;
        $this->currentStep=2;
    }

    public function secondStepSubmit_edit(){
        $this->updateMode = true;
        $this->currentStep=3;
    }


    public function secondStepSubmit(){
        $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required|unique:my_parents,mather_national_id,' . $this->id,
            'Passport_ID_Mother' => 'required|unique:my_parents,mather_passport_id,' . $this->id,
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);
        $this->currentStep=3;
    }

    public function showformadd(){
        $this->showTable=false;
    }

    public function clearForm(){
        $this->Email='';
        $this->Password='';
        $this->Name_Father='';
        $this->Name_Father_en='';
        $this->National_ID_Father='';
        $this->Passport_ID_Father='';
        $this->Phone_Father='';
        $this->Job_Father='';
        $this->Job_Father_en='';
        $this->Nationality_Father_id='';
        $this->Blood_Type_Father_id='';
        $this->Address_Father='';
        $this->Religion_Father_id='';
        $this->Name_Mother='';  
        $this->Name_Mother_en='';
        $this->National_ID_Mother='';
        $this->Passport_ID_Mother='';
        $this->Phone_Mother=''; 
        $this->Job_Mother='';
        $this->Job_Mother_en='';
        $this->Nationality_Mother_id=''; 
        $this->Blood_Type_Mother_id='';
        $this->Address_Mother=''; 
        $this->Religion_Mother_id='';    
    }

    public function back($page){
        $this->currentStep=$page;
    }

    public function submitForm(){

       $myparent= MyParent::create([
            'email'=>$this->Email,
            'password'=>Hash::make($this->Password),
            'father_name'=>['en'=>$this->Name_Father_en,'ar'=>$this->Name_Father],
            'father_national_id'=>$this->National_ID_Father,
            'father_passport_id'=>$this->Passport_ID_Father,
            'father_phone'=>$this->Phone_Father,
            'father_job'=>['ar'=>$this->Job_Father,'en'=>$this->Job_Father_en],
            'father_nationality_id'=>$this->Nationality_Father_id,
            'father_blood_type_id'=>$this->Blood_Type_Father_id,
            'father_religion_id'=>$this->Religion_Father_id,
            'father_address'=>$this->Address_Father,
            'mather_name'=>['en'=>$this->Name_Mother_en,'ar'=>$this->Name_Mother],
            'mather_national_id'=>$this->National_ID_Mother,
            'mather_passport_id'=>$this->Passport_ID_Mother,
            'mather_phone'=>$this->Phone_Mother,
            'mather_job'=>['ar'=>$this->Job_Mother,'en'=>$this->Job_Mother_en],
            'mather_nationality_id'=>$this->Nationality_Mother_id,
            'mather_blood_type_id'=>$this->Blood_Type_Mother_id,
            'mather_religion_id'=>$this->Religion_Mother_id,
            'mather_address'=>$this->Address_Mother
        ]);
          if(!empty($this->photos)){
            foreach($this->photos as $photo){
              $photo->storeAs($this->National_ID_Father,$photo->getClientOriginalName(),$disk="parent_attachments");
                ParentAttachment::create([
                    'file_name'=>$photo->getClientOriginalName(),
                    'parent_id'=>$myparent->id
                    ]);        
            }
          }    
    if($myparent){
        $this->successMessage=__('main_trans.Data has been saved successfully!');
        $this->clearForm();
        $this->showTable=true;
    }



    }

    public function edit($id){
    $this->images=[];
    $this->updateMode=true;
    $this->showTable=false;
    $parent=MyParent::find($id);
    $this->parent_id=$parent->id;
    $this->Email=$parent->email;
    $this->Name_Father=$parent->getTranslation('father_name','ar');
    $this->Name_Father_en=$parent->getTranslation('father_name','en');
    $this->National_ID_Father=$parent->father_national_id;
    $this->Passport_ID_Father=$parent->father_passport_id;
    $this->Phone_Father=$parent->father_phone;
    $this->Job_Father=$parent->getTranslation('father_job','ar');
    $this->Job_Father_en=$parent->getTranslation('father_job','en');
    $this->Nationality_Father_id=$parent->father_nationality_id;
    $this->Blood_Type_Father_id=$parent->father_blood_type_id;
    $this->Address_Father=$parent->father_address;
    $this->Religion_Father_id=$parent->father_religion_id;
    $this->Name_Mother=$parent->getTranslation('mather_name','ar');  
    $this->Name_Mother_en=$parent->getTranslation('mather_name','en');
    $this->National_ID_Mother=$parent->mather_national_id;
    $this->Passport_ID_Mother=$parent->mather_passport_id;
    $this->Phone_Mother=$parent->mather_phone; 
    $this->Job_Mother=$parent->getTranslation('mather_job','ar');
    $this->Job_Mother_en=$parent->getTranslation('mather_job','en');
    $this->Nationality_Mother_id=$parent->mather_nationality_id; 
    $this->Blood_Type_Mother_id=$parent->mather_blood_type_id;
    $this->Address_Mother=$parent->mather_address; 
    $this->Religion_Mother_id=$parent->mather_religion_id;
    foreach($parent->attachments as $attachment){
        $this->images[]= $attachment->file_name; 
    } 
    }

    public function submitForm_edit(){
        $myparent=MyParent::find($this->parent_id);
        $myparent->update([
             'email'=>$this->Email,
             'password'=>empty($this->password)?$myparent->password:Hash::make($this->Password),
             'father_name'=>['en'=>$this->Name_Father_en,'ar'=>$this->Name_Father],
             'father_national_id'=>$this->National_ID_Father,
             'father_passport_id'=>$this->Passport_ID_Father,
             'father_phone'=>$this->Phone_Father,
             'father_job'=>['ar'=>$this->Job_Father,'en'=>$this->Job_Father_en],
             'father_nationality_id'=>$this->Nationality_Father_id,
             'father_blood_type_id'=>$this->Blood_Type_Father_id,
             'father_religion_id'=>$this->Religion_Father_id,
             'father_address'=>$this->Address_Father,
             'mather_name'=>['en'=>$this->Name_Mother_en,'ar'=>$this->Name_Mother],
             'mather_national_id'=>$this->National_ID_Mother,
             'mather_passport_id'=>$this->Passport_ID_Mother,
             'mather_phone'=>$this->Phone_Mother,
             'mather_job'=>['ar'=>$this->Job_Mother,'en'=>$this->Job_Mother_en],
             'mather_nationality_id'=>$this->Nationality_Mother_id,
             'mather_blood_type_id'=>$this->Blood_Type_Mother_id,
             'mather_religion_id'=>$this->Religion_Mother_id,
             'mather_address'=>$this->Address_Mother
         ]);
           if(!empty($this->photos)){
            if($myparent->attachments()->count()){
                $myparent->attachments()->delete();
                $folder=$myparent->father_national_id;
                $directory = 'parent_attachments/'.$folder;
                Storage::deleteDirectory($directory);
            }
             foreach($this->photos as $photo){
               $photo->storeAs($this->National_ID_Father,$photo->getClientOriginalName(),$disk="parent_attachments");
                      ParentAttachment::updateOrCreate([
                     'file_name'=>$photo->getClientOriginalName(),
                     'parent_id'=>$this->parent_id
                     ]);
             }
           }    
     if($myparent){
        $this->successMessage=__('main_trans.It updated successfully!');
         $this->clearForm();
         $this-> currentStep=1;
         $this->showTable=true;
         $this->updateMode=false;
     }
 
 
 
     }

     public function delete($id){
        $parent=MyParent::find($id);
            if($parent->attachments()->count()){
                $parent->attachments()->delete();
                $folder=$parent->father_national_id;
                $directory = 'parent_attachments/'.$folder;
                Storage::deleteDirectory($directory);

            }
        if($parent->delete()){
            $this->showTable=true;
            $this->successMessage=__('main_trans.data deleted successfully');        
        }

     }
 
}
