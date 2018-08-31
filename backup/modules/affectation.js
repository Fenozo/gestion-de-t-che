var affectationController = function($scope,api,root){
    $scope.s = 's';
    // $scope.neW = true;
    $scope.show = true;
    $scope.item = "Liste des";

    $scope.employees = [];
    $scope.employee = {};
    $scope.employeesActif = [];
    $scope.panel = 1;
    $scope.pointageProfil = {};
    $scope.search = {sexe:''};
    $scope.pointages = [];
    $scope.newProfil = {poste:null};
    $scope.popupFiche = false;
    $scope.equipements = [];

    $scope.objectAffecter = [];

    $scope.affectations_1 = true;
    $scope.affectations_3 = false;

     $scope.affected = [];
     $scope.count_affected = 0;
     $scope.devant_text_affectee = null;
     $scope.fin_text_affectee = null;
     $scope.text_affected = null;

    /*
    * Réupération département
    */
    $scope.getDepartement = function(code)
    {
        switch(parseInt(code))
        {
            case 1:
            break;

            case 2:
            break;

            case 3:
            break;

            case 4:
            break;

            case 8:
                return "Développeur d'application";

            default:
                return "Non ajouté dans la base.";
        }
    }

    $scope.init = function(url){
        root.chemin(url);
    }

    $scope.getEtatEquipement = function(etat) {
        switch(parseInt(etat)) {
            case 3:
                return "Endommag&eacute;";
            break;

            case 8:
                return "Bonne occasion";
            break;

            case 10:
                return "Neuf";
            break;
        }
    }
   
    $scope.listeEquipements = function(id){

 
        api.find('equipement',null).then(function(response) {
            if(response.status==200) {
                /*
                * Data optimization
                */
                
                    $scope.affected = [];
                    $scope.equipements = [];
                

                angular.forEach(response.data,function(current,key) {
                    if($scope.employee.id){
                        if(current.id_affectation == $scope.employee.id){
                            //$scope.count_affected++;
                            $scope.affected.push(current);    // matériels qui sont déjà affécté par une pérsonne         
                        }else if(current.id_affectation == -1){
                            $scope.equipements.push(current);    // c'est ici que l'application tire les afféctations
                                // qui ont une afféctation égale à -1  
                          }
                        

                    }else {
                        if(current.id_affectation == -1){
                            $scope.equipements.push(current);     
                        }
                    }
                    
                    
                });

                 
            }
           // console.log($scope.affected);
           //console.log($scope.employee);
           $scope.Afficher_Texte_Equipement_affecter();               
        });
    }

    $scope.setSexe = function(){
        var sexe = $scope.employee.sexe;
        switch(sexe){
            case 'Femme':
            return 'Mme'
            break;
            case 'Homme':
            return 'Mr'
            break;
            default:
            return 'Homme';
        }
    }
    $scope.Afficher_Texte_Equipement_affecter = function(){
      //  console.log($scope.employee);

        if( $scope.affected.length >0 ){
            $scope.text_affected = $scope.setSexe()+' '+$scope.employee.nom;
            $scope.devant_text_affectee = 'Le nombre des matériels affecté à ';
            $scope.fin_text_affectee = ' est '+ $scope.affected.length;
        }else{
            $scope.text_affected ='Aucun n\'est définit pour le moment.';
        }
    }

    $scope.reset = function(){
        $scope.popupFiche = false;
        $scope.objectAffecter = [];

        $scope.openWindow();
    }
/*

    L'affectation commence ici

*/
$scope.openWindow =  function (){

             if($scope.objectAffecter.length>0){

                $scope.affectations_1 = false;
                $scope.affectations_3 = true;
                //console.log($scope.objectAffecter.length);
            }else{
                $scope.affectations_1 = true;
                $scope.affectations_3 = false;
            }

}

    $scope.analyseTableau = function(id_employee){
        //console.log($scope.employee.id);

        angular.forEach($scope.objectAffecter,function(data,key){
            if(data.id_affectation!= -1 && id_employee != data.id_affectation){
                $scope.objectAffecter = [];

                data.id_affectation = id_employee;
                $scope.objectAffecter.push(data);
            }
        });

        $scope.openWindow();

    }

    $scope.setAffect = function(object,newAffectation){

        var id_employee = $scope.employee.id;
        //$scope.objectAffecter = [];

        if(newAffectation.id ==true && object.id_affectation == -1){
   
            object.id_affectation = id_employee;

            Already($scope.objectAffecter,object);

        }else if(newAffectation.id ==false && object.id_affectation == id_employee){

           // newAffectation.id = false;
   
            angular.forEach($scope.objectAffecter,function(current,key){
                if(object == current){
                    current.id = object.id;
                   // console.log(key);
                    current.id_affectation = -1;
                    $scope.objectAffecter.splice(key,1); // suppréssion de l'objet ayant un newAffectation qui est égal à false
                    /*
                        remarque : pour supprimer un élément dans un tableau en javascsript il faut le ciblé par son index
                        puis que les éléments sont dans un tableau indéxé
                    */
                }
            });

        }
        
        $scope.analyseTableau(id_employee);

        function Already(objet,set){
            objet.push(set);
            
        }

       

        //console.log($scope.objectAffecter);
    }

    $scope.valider_affectation = function(){
        angular.forEach($scope.objectAffecter,function(current,key){

            api.update('equipement',current).then(function(r){
                console.log(r);
            })
        })
        
        //console.log($scope.objectAffecter);
    }

/*

    L'affectation se términe ici

*/



    $scope.chargerEmployers = function() {
        //var critere = {'non_affecter':-1};

        api.find('employee',null).then(function(response) {
            if(response.status==200) {
                /*
                * Data optimization
                */
                $scope.employees = [];
                angular.forEach(response.data,function(value) {
                    $scope.employees.push(value);
                });
            }
        })
    }
   

    $scope.afficherMessage = function(message) {
        Materialize.toast(message,3000);
    }

     $scope.setAffectation = function(employee) {
        $scope.popupFiche = true;
        $scope.employee = angular.copy(employee);
        $scope.equipements = $scope.listeEquipements();
        
        $scope.listeEquipements();
    }

   $scope.chargerEmployers();
   

   //console.log($scope.equipements);

}