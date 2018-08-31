var mainController = function(api,$scope,$parse) {
    $scope.employees = [];
    $scope.employee = {};
    $scope.employeesActif = [];
    $scope.panel = 1;
    $scope.pointageProfil = {};
    $scope.search = {sexe:''};
    $scope.pointages = [];
    $scope.newProfil = {poste:null};

    /*
    * Début Popup consultation fiche 
    */
    $scope.popupFiche = false; 

    $scope.setProfil = function(profil) {
        $scope.popupFiche = true;
        $scope.employee = angular.copy(profil);

        //console.log($scope.employee);
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

    $scope.setPointageProfil = function(profil) {
        $scope.pointageProfil = angular.copy(profil);
        $('.popup_pointage').fadeOut(400);
    }

    $scope.sauvegarderPointage = function(type) {
        if($scope.pointageProfil && type) {
            if(confirm("Voulez-vous réellement valider ce pointage?")) {
                $scope.pointageProfil.type = type;

                if(typeof type === 'object') {
                    api.update('pointage',type).then(function(response) {
                        if(response.status==200) {
                            Materialize.toast('Pointage effectué avec succès!',3000);
                            $scope.recuperationPointage();
                        }
                    })
                } else if(type="entree") {
                    api.save('pointage',$scope.pointageProfil).then(function(response) {
                        if(response.status==200) {
                            if(response.data=="existant") {
                                Materialize.toast('Cet employé est déjà dans les bureaux!',3000);    
                                return null;
                            }
                            Materialize.toast('Pointage effectué avec succès!',3000);
                            $scope.recuperationPointage();

                            $scope.pointageProfil = [];
                        }
                    })
                } 
                


            }
        }
    }

    $scope.recuperationProfil = function() {
        /*if (type_utilisateur=='minimal') {
            critere = {'etat':null};
        }
        if (type_utilisateur=="moyen") {
            critere = {'etat':null};
        } else if (type_utilisateur=="maximal") {
            critere = {'etat':'1'};
        }*/
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

    $scope.recuperationProfilActif = function() {
        critere = {'etat':'2'};
        api.find('employee',critere).then(function(response) {
            if(response.status==200) {
                /*
                * Data optimization
                */
                $scope.employeesActif = [];
                angular.forEach(response.data,function(value) {  
                    $scope.employeesActif.push(value);
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

    $scope.removeProfil = function(value) {        
        if(confirm('Voulez - vous réellement supprimer ce profil ?')) {
            api.remove('employee',value).then(function(response) {
                $scope.employees = [];
                $scope.recuperationProfil();
                Materialize.toast('Profil supprime avec succès!',3000);
            });
        }
    }

    $scope.confirmerProfil = function(profil) {
        if(confirm('Voulez - vous réellement confirmer ce profil ?')) {
            if(type_utilisateur=="moyen") {
                profil.etat = '1'
            } else if(type_utilisateur=="maximal") {
                profil.etat = '2'
            }
            api.update('employee',profil).then(function(response) {
                $scope.employees = [];
                $scope.recuperationProfil();
                Materialize.toast('Profil confirmé avec succès!',3000);
            });
        }
    }

    $scope.sauvegardeProfil = function() {
        api.save('employee',$scope.newProfil).then(function(response) {
            if(response.status==200) {

                console.log(response);

                $scope.employees = [];
                $scope.recuperationProfil();
                $scope.newProfil = {};
                $scope.changePanel(1);
                $scope.recuperationProfilActif();
                Materialize.toast('Profil ajouté avec succès!',3000);
            }
        })
    }

    $scope.cinRegex = '/^[0-9]+$/';

    $scope.changePanel = function(value) {
        if(value==2) {
           /*
            *  
            $('#cin').mask('999 999 999 999'); 
            */
            setTimeout(function(){
                $('html, body').animate({scrollTop: $('#newprofilform').offset().top}, 400,'easeInOutCubic');
                $('#nom').focus();
            },500)
        }
        $scope.panel = value;
    }

    $scope.recuperationProfil();
    $scope.recuperationProfilActif();
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
                $('.selection_profil_pointage').on('focus',function() {
                   $('.popup_pointage').fadeIn(400);
                });
            }
        });
    },500);
}
