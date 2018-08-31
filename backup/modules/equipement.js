var equipementController = function(api,$scope) {
    $scope.equipements = [];

    /* 
        Etat des materiels et equipements
        neuf = 10;
        bonne_occasion = 8;
        endomager = 3;
    */
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
    var equipements = [];

    $scope.chargerEquipements = function() {
        //var critere = {'non_affecter':-1};

        api.find('equipement',null).then(function(response) {
            if(response.status==200) {
                /*
                * Data optimization
                */
                $scope.equipements = [];
                 
                angular.forEach(response.data,function(value) {
                    $scope.equipements.push(value);
                     equipements.push(value);
                });

            }

        })
    }
    
    $scope.sauvegardeEquipement = function() {
        angular.forEach($scope.newEquipement,function(v,k){
            if(v == 'neuf'){
                $scope.newEquipement.etat = 10;
            }else if(v == 'bonne_ocasion'){
                $scope.newEquipement.etat = 8;
            }else if(v == 'endomager'){
                $scope.newEquipement.etat = 3;
            }
            
        });

        //console.log($scope.newEquipement);
        api.save('equipement',$scope.newEquipement).then(function(response) {
            if(response.status==200) {
                $scope.equipements = [];
                $scope.chargerEquipements();

                //console.log(response);

                $scope.newEquipement = {};
                Materialize.toast('Equipement ajouté avec succès!',3000);
            }
        })
    }

    $scope.afficherMessage = function(message) {
        Materialize.toast(message,3000);
    }

    $scope.s = 's';

    // $scope.neW = true;
    $scope.show = true;
    $scope.item = "Liste des";

    $scope.nouveau = function(){
        $scope.item ="Ajout d'un nouveau";
        $scope.s = '';

        if($scope.item =="Ajout d'un nouveau"){
		    $scope.neW = true;
            $scope.show = false;
	    }

    }

    $scope.list = function(){
            $scope.item = "Liste des";
            $scope.s = 's';

            if($scope.item == "Liste des"){
                $scope.show = true;
                $scope.neW = false;
        }
    }

     $scope.setAffectation = function(equipement) {
        $scope.popupFiche = true;
        $scope.equipement = angular.copy(equipement);

        //console.log($scope.employee);
    }

   $scope.chargerEquipements();
  
}