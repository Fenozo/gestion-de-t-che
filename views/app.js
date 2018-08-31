var routing = function($routeProvider) {
	$routeProvider.when('/', {
		templateUrl: 'views/'+type_utilisateur+'/dashboard.php',
		controller: mainController
	})
	/*
	* Customer
	*/
	.when('/contenu_projet', {
		templateUrl: 'views/'+type_utilisateur+'/contenu_projet.php',
		controller: contenu_projetController
	})
	/*
	* affectation des matériels
	*/
	.when('/affectation', {
		templateUrl: 'views/'+type_utilisateur+'/affectation.php',
		controller: affectationController
	})
	.otherwise({redirectTo: '/'});
}

angular.module('manager',["ngRoute"])
.config(['$routeProvider', routing])
.run(function($rootScope){

  $rootScope.$on('$stateChangeStart',function(event, toState,current){
	  
	alert(current)
  });
})
.controller("rootController",function($scope,$location){
	 $scope.neW = false;

	$scope.getPath = function(argument){
		//alert(argument)
		//$location.path(argument);
		$scope.list();
	}
	$scope.list = function(){
            $scope.item = "Liste des";
            $scope.s = 's';

            if($scope.item == "Liste des"){
                $scope.show = true;
                $scope.neW = false;
            
        	}
   		 }
})
.factory('root',['$http','$location',function($http,$location){
	 var service = {
		 chemin : function(param){
			 $location.path(param);
			// alert(param)
		 }
	 }
	 return service;
}])
.directive("fileInput",function($parse){
	return {
		link: function ($scope,element,attrs){
			element.on("change",function(event){
				var files = event.target.files;
				// console.log(files[0].name);
				$parse(attrs.fileInput).assign($scope,element[0].files);
				$scope.$apply();
			})
		}
	}
})
.factory('api', ['$http', function($http) {
	var service = {

		find: function(collection,data) {
			return $http({
	  			method: "POST",
	  			url: "api/api.php?collection="+collection+"&find=true&id_utilisateur="+id_utilisateur,
	  			data: data,
	  			headers: {'Content-Type': 'application/json'}
	  		})
		},

		save: function(collection,data,data_file) {
			if(data_file){
				 data_file = "&file="+data_file;
			}else{
				data_file = null;
			}
			
			return $http({
	  			method: "POST",
	  			url: "api/api.php?collection="+collection+"&save=true&id_utilisateur="+id_utilisateur+data_file,
	  			data: data,
	  			headers: {'Content-Type': 'application/json'}
	  		})
		},

		update: function(collection,data) {
			return $http({
	  			method: "POST",
	  			url: "api/api.php?collection="+collection+"&update=true&id_utilisateur="+id_utilisateur,
	  			data: data,
	  			headers: {'Content-Type': 'application/json'}
	  		})
		},

		remove: function(collection,data) {
			return $http({
	  			method: "POST",
	  			url: "api/api.php?collection="+collection+"&remove=true&id_utilisateur="+id_utilisateur,
	  			data: {code:data.code},
	  			headers: {'Content-Type': 'application/json'}
	  		})
		},

		count: function(data) {
			var i = 0;
			angular.forEach(data, function(validationKey){
				i++;
			});
			return i;
		},
		push :function(data){
			return $http({
				method: "POST",
	  			url: "api/api.php?collection="+collection+"&push=true&id_utilisateur="+id_utilisateur,
	  			data: data,
	  			headers: {'Content-Type': 'application/json'}
			})
		}
	};
	
	return service;
}]);

