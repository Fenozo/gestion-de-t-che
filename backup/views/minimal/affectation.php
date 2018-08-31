<div class="row">
    <div class="col s12 animated fadeIn" style="padding:35px 25px; border:1px solid #ddd">
        <div class="col s12">
            <div class="col s12">
                <h4 style="font-size:18px; font-weight:500;">{{item}} matériel{{s}} et &eacute;quipement{{s}} :</h4>
            </div>
    
            <div class="col s12">
                <!-- -->
            </div>
            <div ng-show="show" class="animated fadeIn">
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
                                <a href="" ng-click="setAffectation(employee)" class="waves-effect waves-light btn">Affecter</a>
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
                <div class="col s11">Fiche d'affectation des équipements pour un employé</div>
                <div class="col s1" style="text-align:right; cursor:pointer;" ng-click="popupFiche = false"><i class="material-icons">close</i></div>
            </div>
            <div class="row">
                <div class="col s3" style="padding:0px 35px; font-size:14px">
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
                <div class="col s9" style="padding:0px 3px; font-size:14px; border-left:1px solid #e1e1e1; height:350px; position:relative;">
                    <div class="card">
                        <div class="waves-effect waves-block waves-light" style="height:275px; overflow:hidden; padding:7px 35px;">
                            <span style="font-weight:400; font-size:18px;">Matériels et équipements utilisés</span>
                            <ul style="padding-top:7px;" ng-show="affectations_1">
                                 {{devant_text_affectee}} <strong>{{text_affected}}</strong> {{fin_text_affectee}}

                                 <div class="col s12">
                                    <table class="striped">
                                        <thead>
                                            <tr>
                                                <th>Marque / mod&egrave;le</th>
                                                <th>Numero de s&eacute;rie</th>
                                                <th>Etat</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <tr ng-repeat="equipement in affected">
                                                <td>{{equipement.marque}} {{equipement.modele}}</td>
                                                <td>{{equipement.numero_serie}} </td>
                                                <td>{{getEtatEquipement(equipement.etat)}}</td>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </ul>
                            <div ng-show="affectations_3" >
                                <!-- {{objectAffecter}} -->
                                <div class="col s12">
                                    <table class="striped">
                                        <thead>
                                            <tr>
                                                <th>Marque / mod&egrave;le</th>
                                                <th>Numero de s&eacute;rie</th>
                                                <th>Etat</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <tr ng-repeat="equipement in objectAffecter">
                                                <td>{{equipement.marque}} {{equipement.modele}}</td>
                                                <td>{{equipement.numero_serie}} </td>
                                                <td>{{getEtatEquipement(equipement.etat)}}</td>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col s12">
                                        <button ng-click="valider_affectation()" class="btn waves-effect waves-light" type="submit" name="action">Submit
                                            <i class="material-icons right">send</i>
                                        </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <p style="text-align:right;"><span class="card-title activator grey-text text-darken-4"><a class="btn-floating btn waves-effect waves-light red"><i class="material-icons">add</i></a></span></p>
                        </div>
                        <div class="card-reveal">
                            <div>
                            <span class="card-title grey-text text-darken-2"><div>Séléctionnez les nouvelles matériels pour une affectation<i class="material-icons right close"> - </i></div> </span>
                               <form>
                                    <div class="equipementsAffectations" ng-repeat="eq in equipements" >
                                        <div class="input-field col s4">
                                            <input type="checkbox"  value="{{eq.id}}" id="{{eq.id}}" ng-model="newAffectation.id" ng-click="setAffect(eq,newAffectation)">
                                            <label for="{{eq.id}}">{{eq.description}}</label>
                                        </div>
                                    </div>
                                    
                               </form>
                            </div>
                        </div>
                    </div>

                </div>
                
            </div>
            <div style=" width:100%; padding:15px 35px; position:absolute; bottom:0; right:0; border-top:1px solid #ccc;">
                <a class="waves-effect waves-light btn grey darken-4 right" ng-click="reset()">Fermer</a>
            </div>
        </div>
    </div>
</div>

<!-- -->