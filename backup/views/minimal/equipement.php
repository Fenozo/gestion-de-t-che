<div class="row">
    <div class="col s12 animated fadeIn" style="padding:35px 25px; border:1px solid #ddd">
        <div class="col s12">
            <div class="col s12">
                <h4 style="font-size:18px; font-weight:500;">{{item}} matériel{{s}} et &eacute;quipement{{s}} :</h4>
            </div>
            <div class="col-dm-12" ng-show="show">
                <button class="waves-effect waves-light btn" ng-click="nouveau()"><span class="valign-wrapper"><i class="material-icons">playlist_add</i>Nouveau</span></button>
                <!--button id="aff_button" class="btn" ng-click="list()">Liste des mat&eacute;riels</button-->
            </div>
            <div class="col s12">
                <form class="form animated fadeIn" ng-show="neW">
                    <div class="input-field">
                        <input id="marque" type="text" name="marque" ng-model="newEquipement.marque" required>
                        <label for="marque">Marque</label>
                    </div>
                    <div class="input-field">
                        <input id="modele" type="text" name="modele" ng-model="newEquipement.modele" required>
                        <label for="modele">Mod&egrave;le</label>
                    </div>
                    <div class="col 12"></div>
                    <div class="input-field">
                        <input id="numero_serie" type="text" name="numero_serie" ng-model="newEquipement.numero_serie" required>
                        <label for="numero_serie">Num&eacute;ro de s&eacute;rie</label>
                    </div>
                    <div class="col 12"></div>
                    <p>
                        <div class="cradio">
                            <input class="with-gap" name="etat" ng-model="newEquipement.etat" value="neuf" type="radio" id="neuf" />
                            <label for="neuf">Neuf</label>
                        </div>
                        <div class="cradio">
                            <input class="with-gap" name="etat" ng-model="newEquipement.etat" value="bonne_ocasion" type="radio" id="bonne_ocasion" />
                            <label for="bonne_ocasion">Bonne occasion</label>
                        </div>
                        <div class="cradio">
                            <input class="with-gap" name="etat" ng-model="newEquipement.etat" value="endomager" type="radio" id="endomager" />
                            <label for="endomager">Endomager</label>
                        </div>
                    </p>
                    <div class="input-field">
                        <input id="description" type="text" name="description" ng-model="newEquipement.description" required>
                        <label for="description">Déscription</label>
                    </div>
                    <div class="input-field">
                        <textarea class="materialize-textarea" id="observation" type="text" name="observation" ng-model="newEquipement.observation" required>
                        </textarea>
                        <label for="observation">Observation</label>
                    </div>
                    <hr>
                    <button type="button" ng-click="list()" class="btn grey" name=""> Annuler</button> <button type="button" ng-click="sauvegardeEquipement()" class="btn" name=""> Enregistrer &eacute;quipement</button>
                </form>
            </div>
            <div ng-show="show" class="animated fadeIn">
                <table class="striped">
                    <thead>
                        <tr>
                            <th>Marque / mod&egrave;le</th>
                            <th>Description</th>
                            <th>Numero de s&eacute;rie</th>
                            <th>Etat</th>
                            <th>Observation</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="equipement in equipements">
                            <td>{{equipement.marque}} {{equipement.modele}}</td>
                            <td>{{equipement.description}} </td>
                            <td>{{equipement.numero_serie}} </td>
                            <td>{{getEtatEquipement(equipement.etat)}}</td>
                            <td>{{equipement.observation}} </td>
                            <td>
                                <!--<a   class="btn">Détaille</a> -->
                                <a ng-click="setAffectation(equipement)" class="btn-floating btn-large red">
                                  <i class="large material-icons">mode_edit</i>
                                </a>
                            </td>
                            <td>
                                <a> <i class="large material-icons">delete</i> </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- -->

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

<!-- -->