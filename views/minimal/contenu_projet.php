<div class="row">
    <div class="col s12 animated fadeIn" style="padding:35px 25px; border:1px solid #ddd">
        <div class="col s12">
            
            <div class="col s12">
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
            </div>
            <div  ng-show="panel==1" class="animated fadeIn">
                 <div class="col s12">
                    <h4 style="font-size:18px; font-weight:500;">Liste des projets :</h4>
                </div>
                <div class="input-field col s3">
                    <button class="waves-effect waves-light btn" ng-click="changePanel(2)"><span class="valign-wrapper"><i class="material-icons">playlist_add</i>Nouveau</span></button>
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
                                <a href="" ng-click="setProjet(projet)">Nouveau contenu</a>
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
                <div class="col s11">Consultation du fiche du projet</div>
                <div class="col s1" style="text-align:right; cursor:pointer;" ng-click="popupFiche = false"><i class="material-icons">close</i></div>
            </div>
            <div class="row">
                <div class="col s4" style="padding:0px 35px; font-size:14px">
                    <div style="width:225px;">
                        <img src="images/{{projet.sexe}}.jpg" style="width:100%; margin-bottom:7px;">
                    </div>
                    <div >
                        <li style="font-weight:600; font-size:18px;">Projet actif </li>
                        <!-- <li>Poste occupé : {{ getDepartement(projet.poste) }}</li> -->
                        <li>Titre : {{projet.titre}}</li>
                        <li>Date d'insertion : {{projet.created_on}} </li>
                        <li>Déscription : {{projet.description}}</li>
                    </div>
                </div>
                <div class="col s4" style="padding:0px 3px; font-size:14px; border-left:1px solid #e1e1e1; height:350px; position:relative;">
                    <div class="card">
                        <div class="waves-effect waves-block waves-light" style="height:275px; overflow:hidden; padding:7px 35px;">
                            <span style="font-weight:400; font-size:18px;">Nouveau contenu ?</span>
                            <ul style="padding-top:7px;">
                                Aucun n'est définit pour le moment.
                            </ul>
                        </div>
                        <div class="card-content">
                            <p style="text-align:right;"><span class="card-title activator grey-text text-darken-4"><a class="btn-floating btn waves-effect waves-light red"><i class="material-icons">add</i></a></span></p>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">Ajout d'une nouvelle contenu<i class="material-icons right">close</i></span>
                            <p>Vous pouvez ajouter une nouvelle contenu lié au projet par ici (Image, description).</p>
    
                            <div class="col s12">
                                <form  method="post" action="#"  >
                                <div class="input-field">
                                    <input id="legende" type="text" name="legende" ng-model="newContenuProjet.legende" required>
                                    <label for="legende">Titre</label>
                                </div>
                                 <div class="input-field">
                                    <input id="description" type="text" name="description" ng-model="newContenuProjet.description" required>
                                    <label for="description">Déscription</label>
                                </div>

                                <input type="file" file-input="files" name="image" ng-model="newContenuProjet.file"  >
                                 <div class="col s12">
                                <button type="button" ng-click="uploadFile();"  class="right waves-effect waves-light btn" >Envoyer</button>
                                </div>
                            </form>
                                
                            </div>
        
                        </div>
                    </div>

                </div>
                <div class="col s4 listes-contenuProjet" style="overflow:auto;padding:0px 35px; font-size:14px; border-left:1px solid #e1e1e1; height:350px; position:relative;">
                    <span style="font-weight:400; font-size:18px;">Liste de toutes les contenues du projet actif</span>
                    <ul style="padding-top:7px;" ng-show="liste_contenuProjet">
                        Aucun n'est définit pour le moment.
                    </ul>
                    <div class="content-page-img" ng-show="liste_contenuProjetFull">
                        <div ng-repeat="cntProjet in contenuProjet" >
                            <li> <img ng-src="{{cntProjet.url_image}}" > | {{cntProjet.legende}} </li>
                        </ul>
                    </div>
                    <!--
                    <ul style="position:absolute; bottom:0; right:0; padding-right:35px;">
                    <a class="btn-floating btn waves-effect waves-light blue"><i class="material-icons">add</i></a>
                    </ul> 
                    -->
                </div>
            </div>
            <div style=" width:100%; padding:15px 35px; position:absolute; bottom:0; right:0; border-top:1px solid #ccc;">
                <a class="waves-effect waves-light btn grey darken-4 right" ng-click="popupFiche = false">Fermer</a>
            </div>
        </div>
    </div>
</div>

<!-- -->
<style type="text/css">
.content-page-img,listes-contenuProjet{
    
}
.content-page-img img{
    width:100%;
    height:100%;
    max-width:105px;
}
</style>