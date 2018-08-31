var mainController = function(api,$scope,$parse) {
    $scope.projets = [];
    $scope.projet = {};
    $scope.projetsActif = [];
    $scope.panel = 1;
    $scope.pointageProjet = {};
    $scope.search = {types:''};
    $scope.pointages = [];
    $scope.newProjet = {};

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



    /*
    * Début Popup consultation fiche 
    */
    $scope.popupFiche = false; 

    $scope.setProjet = function(Projet) {
        $scope.popupFiche = true;
        $scope.projet = angular.copy(Projet);

      //  console.log($scope.projet);
    }

    $scope.closePopup = function() {

    }

    /*
    * Fin popup consultation fiche
    */

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

    $scope.setPointageProjet = function(Projet) {
        $scope.pointageProjet = angular.copy(Projet);
        $('.popup_pointage').fadeOut(400);
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

    $scope.recuperationPointage = function() {
        api.find('pointage',null).then(function(response) {
            if(response.status==200) {
                /*
                * Data optimization
                */
                $scope.pointages = [];
                angular.forEach(response.data,function(value) {  
                    $scope.pointages.push(value);
                });
            }
        })
    }

    $scope.removeProjet = function(value) {        
        if(confirm('Voulez - vous réellement supprimer ce Projet ?')) {
            api.remove('projet',value).then(function(response) {
                $scope.projets = [];
                $scope.recuperationProjet();
                Materialize.toast('Projet supprime avec succès!',3000);
            });
        }
    }

    $scope.confirmerProjet = function(Projet) {
        if(confirm('Voulez - vous réellement confirmer ce Projet ?')) {
            if(type_utilisateur=="moyen") {
                Projet.etat = '1'
            } else if(type_utilisateur=="maximal") {
                Projet.etat = '2'
            }
            api.update('projet',Projet).then(function(response) {
                $scope.projets = [];
                $scope.recuperationProjet();
                Materialize.toast('Projet confirmé avec succès!',3000);
            });
        }
    }

    

    $scope.cinRegex = '/^[0-9]+$/';

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
    $scope.recuperationPointage();
        

    setTimeout(function() {
        $(document).ready(function() {
            $('select').material_select();
            $('select').change(function(){
                var newValuesArr = null,
                    select = $(this),
                    ul = select.prev();
                    ul.children('li').toArray().forEach(function (li, i) {
                    if ($(li).hasClass('active')) {
                        newValuesArr = select.children('option').toArray()[i].value;
                    }
                });

                var ngModel = $(select).attr('ng-model');

                if (!ngModel=="") {
                    var model = $parse(ngModel);

                    model.assign($scope, newValuesArr);

                    $scope.$apply();
                }
            });
            $('.dropdown-button').dropdown({
                inDuration: 300,
                outDuration: 225,
                constrainWidth: false, // Does not change width of dropdown to that of the activator
                hover: true, // Activate on hover
                gutter: 0, // Spacing from edge
                belowOrigin: false, // Displays dropdown below the button
                alignment: 'left', // Displays dropdown with edge aligned to the left of button
                stopPropagation: false // Stops event propagation
                }
            );

            if(type_utilisateur=="minimal"){
                $('.selection_Projet_pointage').on('focus',function() {
                   $('.popup_pointage').fadeIn(400);
                });
            }
        });
    },500);
}
