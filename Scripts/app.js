// app.js
// create angular app
var validationApp = angular.module('validationApp', []);

// create angular controller
validationApp.controller('mainController', function ($http) {
    //firstName
    var vm = this;
	vm.services = [
    {ServiceID: 'Management', ServiceName: 'Management'},
    {ServiceID: 'Floor Staff', ServiceName: 'Floor Staff'},
    {ServiceID: 'Barista', ServiceName: 'Barista'},
    {ServiceID: 'Chefs', ServiceName: 'Chefs'},
	{ServiceID: 'Kitchen Hand', ServiceName: 'Kitchen Hand'}

  ];
  
    vm.firstname = "";
    vm.lastname = "";
   // vm.postcode = 3976;
    vm.email = "";
    //vm.mobile = 98883;
    vm.position = "select";
    vm.message = "";
	vm.updateMessageToUser ="";
  // function to submit the form after all validation has occurred            
  vm.submitForm = function(isValid) {

    // check to make sure the form is completely valid
      if (isValid) {

          var url = "processApplication.php";
          var data = {
              'first_name': this.firstname, 'last_name': this.lastname, 'postcode': this.postcode,
              'email': this.email, 'mobile': this.mobile, 'position': this.position, 'message': this.message
          };

          var config = {
              headers: {
                  'Content-Type': 'application/json'
              }
          }

          $http.post(url, data, config)
            .then(
               function (response) {
                   // success callback
				   if (response === "success"){
					    /*vm.firstname = "";
						vm.lastname = "";
					    vm.postcode = "";
						vm.email = "";
						vm.mobile = "";
						vm.position = "select";
						vm.message = "";
						*/
					vm.updateMessageToUser = "Thanks for sending your message! We'll get back to you shortly.";
				   }
				   else{
					vm.updateMessageToUser = "There was a problem sending your message. Please try again."; 
				   }
               },
               function (response) {
                   // failure callback
                   vm.updateMessageToUser = "There was a problem sending your message. Please try again.";
               }
            );

    }

  };

});