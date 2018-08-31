<div class="row">
    <div class="col s6 offset-s3 animated fadeIn" style="padding:35px 25px; border:1px solid #ddd;" ng-show="panel==2">
        <form name="newprofiForm" novalidate ng-submit="sauvegardeProfil()">
            <h5 class="green-text">Ajout d'un nouveau profil</h5>
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
            <div class="input-field">
                <input id="cin" type="text" name="cin" ng-model="newProfil.cin" required>
                <label for="cin">C.I.N</label>
            </div>
            <div class="input-filed">
                <select ng-model="newProfil.categorie" name="categorie" required>
                    <option value="" selected>Choisir une catégorie</option>
                    <option value="1">Catégorie 1</option>
                    <option value="2">Catégorie 2</option>
                </select>
            </div>
            <div class="input-field col s6">
                <button type="button" class="waves-effect waves-light btn" ng-click="changePanel(1)">Annuler</button>
            </div>
            <div class="input-field col s6">
                <button type="submit" class="waves-effect waves-light btn" ng-disabled="!newprofiForm.$valid">Sauvegarder</button>
            </div>
        </form>
    </div>
    <div class="col s12"></div>
    <div class="col s12 animated fadeIn" style="padding:35px 25px; border:1px solid #ddd;" ng-show="panel==1">
        <div>
            <h4 style="font-size:18px; font-weight:500;">Liste des extras en attentes de confirmation :</h4>
        </div>
        <div class="input-field col s2">
            <button class="waves-effect waves-light btn" ng-click="changePanel(2)" disabled><i class="material-icons">playlist_add</i> </button>
        </div>
        <div class="input-field col s4">
            <input id="search" type="text" ng-model="search.all">
            <label for="search">Recherche</label>
        </div>
        <div class="col s4">
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
        <div class="col s12"></div>
        <div class="col s4 animated fadeIn" ng-repeat="profil in profils | filter:{sexe:search.sexe} | filter:search.all">
            <div style="border:1px solid #558b2f; margin-top:13px;" class="z-depth-1">
                <p class="center-align light-green darken-3 white-text" style="padding:15px 0px; padding-bottom:7px;"><strong>{{ profil.code}}</strong></p>
                <p ng-hide="profil.image" class="right-align" style="padding:13px 15px; padding-bottom:5px;"><img style="width:45%;" src="images/user.png"/></p>    
                <p style="padding:13px 15px;">
                    Nom : {{ profil.nom }}<br/>
                    Prénom : {{ profil.prenom }}<br/>
                    Sexe : {{ profil.sexe }}<br/>
                    Catégorie : {{ profil.categorie }}
                    <div class="row" style="padding-bottom:13px; margin:0;">
                        <div class="col s4 offset-s2">
                            <a href="" ng-click="">Refuser</a>
                        </div>
                        <div class="col s4 ">
                            <a href="" ng-click="confirmerProfil(profil)">Confirmer</a>
                        </div>
                    </div>
                </p>                
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col s12 animated fadeIn" style="padding:35px 25px; border:1px solid #ddd">
        <div>
            <h4 style="font-size:18px; font-weight:500;">Liste des mouvements :</h4>
        </div>
        <table class="striped">
            <thead>
                <tr>
                    <td width="175px">Date</td>
                    <td>Nom & prénom</td>
                    <td width="115px">Entrée</td>
                    <td width="115px">Sortie</td>
                </tr>
            </thead>
            <tbody>
                <tr ng-hide="pointages.length>0">
                    <td colspan="5" style="text-align:center"><span style="font-size:13px;">Vide pour le moment.</span></td>
                </tr>
                <tr ng-repeat="pointage in pointages">
                    <td>{{pointage.createOn}}</td>
                    <td>{{pointage.nom}} {{pointage.prenom}}</td>
                    <td>{{pointage.heure_entree}}</td>
                    <td>{{pointage.heure_sortie}}</td>

                </tr>
            </tbody>
        </table>
    </div>
</div>