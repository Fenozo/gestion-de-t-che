<!--
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
                            <input type="text" id="champ_recherche" ng-model="search_Projet_pointage">
                            <label for="champ_recherche">Rechercher le nom ici</label>
                        </div>
                    </li>
                    <li class="collection-item Projet-box" ng-repeat="Projet in ProjetsActif | limitTo:5 | filter:search_Projet_pointage" ng-click="setPointageProjet(Projet)">{{Projet.nom}} {{Projet.prenom}}</option>
                </ul>
            </div>
        </div>
    </div>
</div>

    -->
<div class="row" style="display:none">
    <div class="col s12 animated fadeIn" style="padding:35px 25px; border:1px solid #ddd">
    <!-- Dropdown Trigger -->
       <!-- 
            <div>
            <h4 style="font-size:18px; font-weight:500;">Entrée ou sortie :</h4>
        </div>
        <div class="row valign-wrapper">
            <div class="col s6">
                <div>
                    <label for="ProjetPointage">Séléctionner un extra</label>
                    <input type="text" id="ProjetPointage" class="selection_Projet_pointage" value="{{pointageProjet.nom}} {{pointageProjet.prenom}}">
                </div>
            </div>
            <div class="col s6">
                <button class="waves-effect waves-light btn" ng-click="sauvegarderPointage('entree')">Entrée</button>
            </div>
        </div>
           -->
    </div>
</div>  
<div class="row" ng-show="panel==1">
    <div class="col s12 animated fadeIn" style="padding:35px 25px; border:1px solid #ddd">
        <div class="col s12">
            <h4 style="font-size:18px; font-weight:500;">Liste des projets :</h4>
        </div>
        <div class="input-field col s3">
            <button class="waves-effect waves-light btn" ng-click="changePanel(2)"><span class="valign-wrapper"><i class="material-icons">playlist_add</i>Nouveau</span></button>
        </div>
        <div class="col s3">
            <a href="">Recherche :</a><input type="text" ng-model="searchProjet">
        </div>
        <div class="col s3">
            <a href="">Filtrer par :</a>
        
             <div style="z-index:9999; position:absolute; padding:15px 35px;">Type :
                <input class="with-gap" name="sexe" value="" id="tout" ng-model="search.type" type="radio" checked>
                <label for="tout">Tout</label>
                <input class="with-gap" name="sexe" value="Maison" id="maison" ng-model="search.type" type="radio">
                <label for="maison">Maison</label>
                <input class="with-gap" name="sexe" value="Plan" id="plan" ng-model="search.type"  type="radio">
                <label for="plan">Plan</label>
            </div>
        </div>
        <div class="col s12">
            <br/>
        </div>
        <table class="striped">
            <thead>
                <tr>
                    <td width="175px">Date d'ajout</td>
                    <td>Titre</td>
                    <td width="250px">Déscription</td>
                    <td width="150px">Action</td>
                </tr>
            </thead>
            <tbody>
                <tr ng-hide="projets.length>0">
                    <td colspan="4" style="text-align:center"><span style="font-size:13px;">Vide pour le moment.</span></td>
                </tr>
                <tr ng-repeat="projet in projets | filter:{types:search.type} | filter:searchProjet">
                    <td>{{projet.created_on}}</td>
                    <td>{{projet.titre}} </td>
                    <td>{{projet.description}}</td>
                    <td>
                        <a href="" ng-click="setProjet(projet)">Consulter fiche</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col s12 animated fadeIn" style="padding:35px 25px; border:1px solid #ddd;" ng-show="panel==2">
        <form name="newprojetForm" novalidate ng-submit="sauvegardeProjet()">
            <h5 id="newprojetForm" class="green-text">Ajout d'un nouveau projet</h5>
            <div class="input-field">
                <input id="titre" type="text" name="titre" ng-model="newProjet.titre" required>
                <label for="titre">Titre</label>
            </div>
            <div class="input-field">
                <textarea class="materialize-textarea" id="description" type="text" name="description" ng-model="newProjet.description" required>
                </textarea>
                <label for="description">Déscription</label>
            </div>
            
            <div class="input-field col s6">
                <button type="button" class="waves-effect waves-light btn grey" ng-click="changePanel(1)">Annuler</button>
                <button type="submit" class="waves-effect waves-light btn" ng-disabled="!newprojetForm.$valid">Sauvegarder</button>
            </div>
        </form>
    </div>
    <div class="col s12"></div>
</div>
<div class="animated fadeIn" ng-show="popupFiche" style="position:fixed; background-color:rgba(0,0,0,0.85); bottom:0; left:0; width:100%; height:100%; z-index:10000">
    <div class="white" style="margin:0 auto; height:525px;position: absolute; top: 50%; left:50%; z-index:9999; width:85%; transform: translate(-50%, -50%); overflow:hidden;">
        <div style="position:relative; height:520px;">
            <div class="row" style="border-bottom:1px solid #ccc; padding:15px 35px; font-size:18px;">
                <div class="col s11">Consultation fiche du projet</div>
                <div class="col s1" style="text-align:right; cursor:pointer;" ng-click="popupFiche = false"><i class="material-icons">close</i></div>
            </div>
            <div class="row">
                <div class="col s4" style="padding:0px 35px; font-size:14px">
                    <div style="width:225px;">
                        <img src="images/{{projet.sexe}}.jpg" style="width:100%; margin-bottom:7px;">
                    </div>
                    <div >
                        <li style="font-weight:600; font-size:18px;">{{projet.titre}} </li>
                        <!-- <li>Poste occupé : {{ getDepartement(projet.poste) }}</li> -->
                        <li>Titre : {{projet.titre}}</li>
                        <li>Déscription : {{projet.description}}</li>
                    </div>
                </div>
                <div class="col s4" style="padding:0px 3px; font-size:14px; border-left:1px solid #e1e1e1; height:350px; position:relative;">
                    <div class="card">
                        <div class="waves-effect waves-block waves-light" style="height:275px; overflow:hidden; padding:7px 35px;">
                            <span style="font-weight:400; font-size:18px;">Affectation au projet</span>
                            <ul style="padding-top:7px;">
                                Aucun n'est définit pour le moment.
                            </ul>
                        </div>
                        <div class="card-content">
                            <p style="text-align:right;"><span class="card-title activator grey-text text-darken-4"><a class="btn-floating btn waves-effect waves-light red"><i class="material-icons">add</i></a></span></p>
                        </div>
                        <div class="card-reveal">
                           
                                <span class="card-title grey-text text-darken-4">Ajout d'une nouvelle affectation au projet<i class="material-icons right">close</i></span>
                            <p>Vous pouvez ajouter une nouvelle Affectation au projet par ici (permission, absence, cong&eacute;s, mission, etc).</p>
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
                    <span style="font-weight:400; font-size:18px;">Action</span>
                    <ul style="padding-top:7px;">
                        <form >
                            <button type="submit" class="waves-effect waves-light btn" >Modification</button>
                        </form>
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