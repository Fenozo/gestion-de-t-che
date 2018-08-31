var contenu_projetController = function(api,$scope,$http) {
    $scope.projets = [];
    $scope.projet = {};
    $scope.projetsActif = [];
    $scope.panel = 1;
    $scope.liste_contenuProjet = true;
    $scope.liste_contenuProjetFull = false;
/**
 *  cette méthode vérifie si l'image n'est pas déjà là ou non ?
 */
$scope.contenuEnCours = function(url_imageEnCours){
    $scope.rechargeContenuProjet();
    var c= 0;
angular.forEach($scope.contenuProjet,function(value) {
    if(url_imageEnCours == value.url_image)  
        {
            c++;
        }              
    })

if(c == 0){
    return true;
}else{

    return false;
}               

}

$scope.uploadFile = function(){
  //  $scope.files = [];
  $scope.fichier = [];

    var form_data = new FormData();
    angular.forEach($scope.files,function(file){
      //  console.log(file);
        $scope.fichier['name'] = file.name;
        $scope.fichier['url'] = "upload/"+$scope.projet.id+ "/"+$scope.fichier['name'];
        $scope.longueur = $scope.fichier['url'].length;
        form_data.append("file",file);
    });

   // console.log("upload/"+$scope.projet.id+ "/"+$scope.fichier['name']);
   // console.log($scope.projet.id +'[['+ form_data+']]');
if($scope.longueur<50){
    $http({
        method: "POST",
        url: "api/api.php?file="+$scope.projet.id,
        data: form_data,
        headers: {'Content-Type' : undefined,'Process-Data':false}
        }).then(function(response){
            
            $scope.valide_save = $scope.contenuEnCours($scope.fichier['url']);
            console.log($scope.valide_save);

        if($scope.valide_save){
            $scope.newContenuProjet.id_projet = $scope.projet.id; // id_projet
            $scope.newContenuProjet.url_image = $scope.fichier['url']; // url_image
            api.save('contenu_projet',$scope.newContenuProjet).then(function(response) {
                if(response.status==200) {

                    //  console.log(response);
                
                    $scope.contentProjets = [];
                    $scope.recuperationProjet();
                    $scope.newProjet = {};
                    $scope.changePanel(1);
                    $scope.recuperationProjetActif();
                    Materialize.toast('Projet ajouté avec succès!',3000);
                }
            });

            }
        })
}else{
    alert('C\'est un nom de fichier trop long qui a besoin d\'être un petit peut');
}


    $scope.rechargeContenuProjet();
        
}
    $scope.rechargeContenuProjet = function(id_projet){
        
        api.find('contenu_projet',null).then(function(response){
                /*
                * Data optimization
                */
                $scope.contenuProjet = [];
                if(id_projet){
                    console.log($scope.projet.id);
                }
                angular.forEach(response.data,function(value) {
                    if(value.id_projet==$scope.projet.id){
                        $scope.liste_contenuProjet = false;
                        $scope.liste_contenuProjetFull = true;
                        $scope.contenuProjet.push(value); // recupération des données puis on les attributs dans le contenu.
                    }
                    
                })
               // console.log($scope.contenuProjet);
        });
        
    }

    $scope.sauvegardeProjet = function() {
            //console.log($scope.newProjet)
        api.save('projet',$scope.newProjet).then(function(response) {
            if(response.status==200) {

                console.log(response);
               
                $scope.projets = [];
                $scope.recuperationProjet();
                $scope.newProjet = {};
                $scope.changePanel(1);
                $scope.recuperationProjetActif();
                Materialize.toast('Projet ajouté avec succès!',3000);
            }
        })
    }


$scope.recuperationProjet = function() {

        api.find('projet',null).then(function(response) {
            if(response.status==200) {
                /*
                * Data optimization
                */
                
                $scope.projets = [];
                angular.forEach(response.data,function(value) {
                    $scope.projets.push(value);
                });
            }
        })
    }

    $scope.recuperationProjetActif = function() {
        critere = {'etat':'2'};
        api.find('projet',critere).then(function(response) {
            if(response.status==200) {
                /*
                * Data optimization
                */
                $scope.projetsActif = [];
                angular.forEach(response.data,function(value) {  
                    $scope.projetsActif.push(value);
                });
            }
        })
    }
      /*
    * Début Popup consultation fiche 
    */
    $scope.popupFiche = false; 

    $scope.setProjet = function(Projet) {
        $scope.popupFiche = true;
        $scope.projet = angular.copy(Projet);
        id_projet = $scope.projet.id;
        $scope.rechargeContenuProjet(id_projet);
        //console.log(id_projet);
    }

    $scope.closePopup = function() {

    }

    /*
    * Fin popup consultation fiche
    */

     $scope.changePanel = function(value) {
        if(value==2) {
           /*
            *  
            $('#cin').mask('999 999 999 999'); 
            */
            setTimeout(function(){
                $('html, body').animate({scrollTop: $('#newProjetform').offset().top}, 400,'easeInOutCubic');
                $('#nom').focus();
            },500)
        }
        $scope.panel = value;
    }

    /**
     * 
     * We need the code this under
     */

    $scope.recuperationProjet();
    $scope.recuperationProjetActif();
    //$scope.rechargeContenuProjet();

    $scope.afficherMessage = function(message) {
        Materialize.toast(message,3000);
    }

 
  
}