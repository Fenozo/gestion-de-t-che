<div class="popup_pointage fadeIn" style="position:fixed; top:0; left:0; display:none; background-color:rgba(0,0,0,0.75); width:100%; height:100%; z-index:9999;" ng-show="panel==1">
    <div class="row">
        <div class="col s6 offset-s3 white" style="padding:35px 45px; margin-top:95px;">
            Choisir l'employé pour le pointage
            <hr>
            <div style="padding-top:25px;">
                <ul class="collection with-header">
                    <li class="collection-header">
                        Liste des employés
                        <div class="input-field">
                            <input type="text" id="champ_recherche" ng-model="search_profil_pointage">
                            <label for="champ_recherche">Rechercher le nom ici</label>
                        </div>
                    </li>
                    <li class="collection-item profil-box" ng-repeat="profil in profilsActif | limitTo:5 | filter:search_profil_pointage" ng-click="setPointageProfil(profil)">{{profil.nom}} {{profil.prenom}}</option>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row" style="display:none">
    <div class="col s12 animated fadeIn" style="padding:35px 25px; border:1px solid #ddd">
    <!-- Dropdown Trigger -->
        <div>
            <h4 style="font-size:18px; font-weight:500;">Entrée ou sortie :</h4>
        </div>
        <div class="row valign-wrapper">
            <div class="col s6">
                <div>
                    <label for="profilPointage">Séléctionner un extra</label>
                    <input type="text" id="profilPointage" class="selection_profil_pointage" value="{{pointageProfil.nom}} {{pointageProfil.prenom}}">
                </div>
            </div>
            <div class="col s6">
                <button class="waves-effect waves-light btn" ng-click="sauvegarderPointage('entree')">Entrée</button>
            </div>
        </div>
    </div>
</div>  
<div class="row" ng-show="panel==1">
    <div class="col s12 animated fadeIn" style="padding:35px 25px; border:1px solid #ddd">
        <div class="col s12">
            <h4 style="font-size:18px; font-weight:500;">Liste des employ&eacute;s :</h4>
        </div>
        <div class="input-field col s3">
            <button class="waves-effect waves-light btn" ng-click="changePanel(2)"><span class="valign-wrapper"><i class="material-icons">playlist_add</i>Nouveau</span></button>
        </div>
        <div class="col s3">
            <a href="">Recherche :</a><input type="text" ng-model="searchEmployee">
        </div>
        <div class="col s3">
            <a href="">Filtrer par :</a>
            <div style="z-index:9999; position:absolute; padding:15px 35px;">Sexe :
                <input class="with-gap" name="sexe" value="" id="tout" ng-model="search.sexe" type="radio" checked>
                <label for="tout">Tout</label>
                <input class="with-gap" name="sexe" value="Homme" id="homme" ng-model="search.sexe" type="radio">
                <label for="homme">Homme</label>
                <input class="with-gap" name="sexe" value="Femme" ng-model="search.sexe" id="femme" type="radio">
                <label for="femme">Femme</label>
            </div>
        </div>
        <div class="col s12">
            <br/>
        </div>
        <table class="striped">
            <thead>
                <tr>
                    <td width="175px">Date d'ajout</td>
                    <td>Nom & prénom</td>
                    <td width="250px">Email / Contact</td>
                    <td width="150px">Action</td>
                </tr>
            </thead>
            <tbody>
                <tr ng-hide="employees.length>0">
                    <td colspan="4" style="text-align:center"><span style="font-size:13px;">Vide pour le moment.</span></td>
                </tr>
                <tr ng-repeat="employee in employees | filter:{sexe:search.sexe} | filter:searchEmployee">
                    <td>{{employee.created_on}}</td>
                    <td>{{employee.nom}} {{employee.prenom}}</td>
                    <td>{{employee.email}} <br/> {{employee.phone}}</td>
                    <td>
                        <a href="" ng-click="setProfil(employee)">Consulter fiche</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col s12 animated fadeIn" style="padding:35px 25px; border:1px solid #ddd;" ng-show="panel==2">
        <form name="newprofiForm" novalidate ng-submit="sauvegardeProfil()">
            <h5 id="newprofilform" class="green-text">Ajout d'un nouveau employ&eacute;</h5>
            <div class="input-field">
                <input id="nom" type="text" name="nom" ng-model="newProfil.nom" required>
                <label for="nom">Nom</label>
            </div>
            <div class="input-field">
                <input id="prenom" type="text" name="prenom" ng-model="newProfil.prenom" required>
                <label for="prenom">Prénom</label>
            </div>
            <div class="input-field">
                Sexe :
                <input class="with-gap" name="sexe" value="Homme" ng-model="newProfil.sexe" id="homme_profil"  type="radio" required>
                <label for="homme_profil">Homme</label>
                <input class="with-gap" name="sexe" value="Femme" ng-model="newProfil.sexe" id="femme_profil" type="radio" required>
                <label for="femme_profil">Femme</label>
            </div>
            <!--div class="input-field">
                <input id="date_embauche" type="text" name="date_embauche" ng-model="newProfil.date_embauche" required>
                <label for="date_embauche">Date embauche</label>
            </div-->
            <div class="input-field">
                <input id="email" type="text" name="email" ng-model="newProfil.email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-field">
                <input id="telephone" type="text" name="telephone" ng-model="newProfil.phone" required>
                <label for="telephone">T&eacute;l&eacute;phone</label>
            </div>
            <!--div class="input-field">
                <input id="cin" type="text" name="cin" ng-model="newProfil.cin" required>
                <label for="cin">C.I.N</label>
            </div-->
            <div class="input-filed">
                <select ng-model="newProfil.poste" name="poste" required>
                    <option value="" selected>Poste occup&eacute; ?</option>
                    <option value="1">Directrice de Projet</option>
                    <option value="2">Directeur des Opérations</option>
                    <option value="3">Conseillère Sénior en Santé Communautaire</option>
                    <option value="4">Spécialiste en Ressources Humaines et Administrations</option>
                    <option value="5">Directrice de Projet Adjoint - Technique</option>
                    <option value="6">Responsable Financière</option>
                    <option value="7">Conseiller Senior en Suivi et Evaluation </option>
                    <option value="8">Développeur d'application</option>
                </select>
            </div>
            <div class="input-field col s6">
                <button type="button" class="waves-effect waves-light btn grey" ng-click="changePanel(1)">Annuler</button>
                <button type="submit" class="waves-effect waves-light btn" ng-disabled="!newprofiForm.$valid">Sauvegarder</button>
            </div>
        </form>
    </div>
    <div class="col s12"></div>
</div>
<div class="animated fadeIn" ng-show="popupFiche" style="position:fixed; background-color:rgba(0,0,0,0.85); bottom:0; left:0; width:100%; height:100%; z-index:10000">
    <div class="white" style="margin:0 auto; height:525px;position: absolute; top: 50%; left:50%; z-index:9999; width:85%; transform: translate(-50%, -50%); overflow:hidden;">
        <div style="position:relative; height:520px;">
            <div class="row" style="border-bottom:1px solid #ccc; padding:15px 35px; font-size:18px;">
                <div class="col s11">Consultation fiche employé</div>
                <div class="col s1" style="text-align:right; cursor:pointer;" ng-click="popupFiche = false"><i class="material-icons">close</i></div>
            </div>
            <div class="row">
                <div class="col s4" style="padding:0px 35px; font-size:14px">
                    <div style="width:225px;">
                        <img src="images/{{employee.sexe}}.jpg" style="width:100%; margin-bottom:7px;">
                    </div>
                    <div >
                        <li style="font-weight:600; font-size:18px;">{{employee.nom}} {{employee.prenom}}</li>
                        <li>Poste occupé : {{ getDepartement(employee.poste) }}</li>
                        <li>Email : {{employee.email}}</li>
                        <li>Téléphone : {{employee.phone}}</li>
                    </div>
                </div>
                <div class="col s4" style="padding:0px 3px; font-size:14px; border-left:1px solid #e1e1e1; height:350px; position:relative;">
                    <div class="card">
                        <div class="waves-effect waves-block waves-light" style="height:275px; overflow:hidden; padding:7px 35px;">
                            <span style="font-weight:400; font-size:18px;">Congés et Absences</span>
                            <ul style="padding-top:7px;">
                                Aucun n'est définit pour le moment.
                            </ul>
                        </div>
                        <div class="card-content">
                            <p style="text-align:right;"><span class="card-title activator grey-text text-darken-4"><a class="btn-floating btn waves-effect waves-light red"><i class="material-icons">add</i></a></span></p>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">Ajout d'une nouvelle absence<i class="material-icons right">close</i></span>
                            <p>Vous pouvez ajouter une nouvelle absence par ici (permission, absence, cong&eacute;s, mission, etc).</p>
                            <div class="input-field col s6">
                                <input type="text" name="date_debut">
                                <label for="date_debut">Date d&eacute;but</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" name="date_fin">
                                <label for="date_fin">Date fin</label>
                            </div>
                            <div class="col s12">
                                <input class="with-gap" name="group3" type="radio" id="permission" checked />
                                <label for="permission">Permission</label><br>
                                <input class="with-gap" name="group3" type="radio" id="absence" checked />
                                <label for="absence">Absence</label><br>
                                <input class="with-gap" name="group3" type="radio" id="conges" checked />
                                <label for="conges">Cong&eacute;s</label><br>
                                <input class="with-gap" name="group3" type="radio" id="mission" checked />
                                <label for="mission">Mission</label><br>
                            </div>
                            <div class="col s12">
                                <button class="right" style="background-color:crimson; border:none; color:white; padding:7px 35px; padding-bottom:6px; border-radius:3px; font-weight:600; font-size:16px;">Valider</button>
                            </div>
                        </div>
                    </div>
                    <!--span style="font-weight:400; font-size:18px;">Congés et Absences</span>
                    
                    <ul style="position:absolute; bottom:0; right:0; padding-right:15px;">
                        <div class="fixed-action-btn toolbar">
                            <a class="btn-floating btn red">
                                <i class="large material-icons">mode_edit</i>
                            </a>
                            <ul>
                                <li class="waves-effect waves-light"><a href="#!"><i class="material-icons">insert_chart</i></a></li>
                                <li class="waves-effect waves-light"><a href="#!"><i class="material-icons">format_quote</i></a></li>
                                <li class="waves-effect waves-light"><a href="#!"><i class="material-icons">publish</i></a></li>
                                <li class="waves-effect waves-light"><a href="#!"><i class="material-icons">attach_file</i></a></li>
                            </ul>
                        </div>
                    </ul-->
                </div>
                <div class="col s4" style="padding:0px 35px; font-size:14px; border-left:1px solid #e1e1e1; height:350px; position:relative;">
                    <span style="font-weight:400; font-size:18px;">Matériels et équipements utilisés</span>
                    <ul style="padding-top:7px;">
                        Aucun n'est définit pour le moment.
                    </ul>
                    <ul style="position:absolute; bottom:0; right:0; padding-right:35px;">
                        <a class="btn-floating btn waves-effect waves-light blue"><i class="material-icons">add</i></a>
                    </ul>
                </div>
            </div>
            <div style=" width:100%; padding:15px 35px; position:absolute; bottom:0; right:0; border-top:1px solid #ccc;">
                <a class="waves-effect waves-light btn grey darken-4 right" ng-click="popupFiche = false">Fermer</a>
            </div>
        </div>
    </div>
</div>