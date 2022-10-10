<x-app-layout>

    <div class="h-full mx-auto my-20 lg:px-0 px-10 lg:w-1/3">
     
      <form class="form" id="pay-form">
        <div id="alert-holder" class="p-4"></div>
        <div class="text-center my-10">
          <p>Please provide your details and click "Pay" to make your payment.</p>
        </div>
        <fieldset class="form-group my-4 row">
          <label class="col-sm-3" for="firstname">First Name</label>
          <div class=" col-sm-9">
            <input class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="firstname" type="text" placeholder="Your First name (optional)" />
          </div>
        </fieldset>

        <fieldset class="form-group my-4  row">
          <label class="col-sm-3" for="lastname">Last Name</label>
          <div class=" col-sm-9">
            <input class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="lastname" type="text" placeholder="Your Last name (optional)" />
          </div>
        </fieldset>

        <fieldset class="form-group my-4  row">
          <label class="col-sm-3" for="email">Email Address</label>
          <div class=" col-sm-9">
            <input class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" required="required" type="email" placeholder="Your Email Address" />
          </div>
          <small class="text-muted col-sm-9 col-sm-offset-3">We'll never share your email with anyone else.</small>
        </fieldset>
        
     
        <fieldset class="form-group row" id="amountinnaira" style="">
          <label class="col-sm-3" for="amount-in-naira">Amount (&#x20a6;)</label>
          <div class="col-sm-9">
            <div class="input-group">
              <input class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="amount-in-naira" required="required" type="number" step="100" placeholder="Amount" />
            </div>
          </div>
        </fieldset>
        
        <fieldset class="form-group row">
          <div class="col-sm-offset-3 col-sm-9">
            <button class="py-2 px-12 bg-indigo-500 text-white rounded mt-4" type="button" onclick="validateAndPay()"> Pay </button>
          </div>
        </fieldset>
 
      </form>

    </div>

  <script src="https://js.paystack.co/v1/inline.js"></script>
  <script>
    // change this to your public key so you 
    // will no more be prompted
    var public_key = '<?php echo  env('PAYSTACK_PUBLIC_KEY') ?>';
    
    /*
     * Start up
     */
    function startUp(){
      checkAmountInKobo();
      promptForPublicKey();
    }
    
    /*
     * check if the public key set is valid
     * 
     * @return bool
     */
    function isValidPublicKey(){
      var publicKeyPattern = new RegExp('^pk_(?:test|live)_','i');
      return publicKeyPattern.test(public_key);
    }
    
    /*
     * Prompt for and set public key to use
     * If public key set is not valid
     */
    function promptForPublicKey(){
      if(!isValidPublicKey()){
        // get a public key to use
        public_key = prompt("To run this sample, you need to provide a public key.\n"+
                            "Please visit https://dashboard.paystack.co/#/settings/developer to get your "+
                            "public key and enter in the box below:", "pk_xxxx_");
        // check that we got a valid public key 
        // (starts with pk_live_ or pk_test_)
        if (!isValidPublicKey()) {
          var error_msg = "You didn't provide a public key. This page will not load.";
          alert(error_msg);
          document.getElementById('pay-form').innerHTML = error_msg;
        }
      }
    }
    /* 
     * Validate before opening Paystack popup
     */
    function validateAndPay(){
      var email = document.getElementById('email').value;
      if(!simpleValidEmail(email)){
        alert("Please provide a valid email");
        return;
      }
      
      var amountinkobo = getAmountInKobo();
      if(!amountinkobo){
        alert("Please provide a valid amount");
        document.getElementById('amountinnaira').style.display="block";
        document.getElementById('static-amount').style.display="none";
        return;
      }
      
      // We are not validating firstname and lastname
      var firstname = document.getElementById('firstname').value;
      var lastname  = document.getElementById('lastname').value;
      
      payWithPaystack(email, amountinkobo, firstname, lastname);
    }
  
    /* Get the query parameters for this window
     * 
     * source: http://stackoverflow.com/a/21210643/671568
     */
    function getParams(){
      var queryDict = {};
      location.search
        .substr(1)
        .split("&")
        .forEach(function(item) {
          queryDict[item.split("=")[0]] = item.split("=")[1];
        });
      return queryDict;
    }
    
    /* Check amount sent by get if it's a valid integer
     * show the amount input box if not
     */
    function checkAmountInKobo(){
      amountinkobo = getParams().amountinkobo;
      
      if(!simpleValidInt(amountinkobo)){
        // show the amount box since an amount was not specified by GET
        document.getElementById('amountinnaira').style.display="block";
        document.getElementById('static-amount').style.display="none";
      } else {
        document.getElementById('amountinngn').innerHTML = amountinkobo / 100;
      }
    }
  
    /* Get amount sent by get if it's a valid integer
     * Get the amount entered in input box  multiplied
     *  by 100. Show alert if no valid amountinkobo can be found
     */
    function getAmountInKobo(){
      amountinkobo = getParams().amountinkobo;
      
      if(!amountinkobo){
        amountinkobo = 100 * +document.getElementById('amount-in-naira').value;
      }
      
      if(!simpleValidInt(amountinkobo)){
        alert("Please provide an amount to pay");
      }
      
      return amountinkobo;
    }
  
    /* Get a random reference number based on the current time
     * 
     * gotten from http://stackoverflow.com/a/2117523/671568
     * replaced UUID with REF
     */
    function generateREF(){
      var d = new Date().getTime();
      if(window.performance && typeof window.performance.now === "function"){
        d += performance.now(); //use high-precision timer if available
      }
      var ref = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = (d + Math.random()*16)%16 | 0;
        d = Math.floor(d/16);
        return (c=='x' ? r : (r&0x3|0x8)).toString(16);
      });
      return ref;
    }
    
    /* Validate integer
     *
     * gotten from http://stackoverflow.com/a/25016143/671568
     */
    function simpleValidInt( data ) {
      if (+data===parseInt(data)) {
        return true;
      } else {
        return false;
      }
    };

    
    /* Validate email address 
     * not meant for really secure email validation
     *
     * gotten from http://stackoverflow.com/a/28633540/671568
     * Had to correct Regex, allowing A-Za-z0-9 to repeat
     */
    function simpleValidEmail( email ) {
      return email.length < 256 && /^[^@]+@[^@]+[A-Za-z0-9]{2,}\.[^@]+[A-Za-z0-9]{2,}$/.test(email);
    };

    function verifyTransaction(payload){
        const http = new XMLHttpRequest()
        let url = '/deposit/verify'
        let csrftoken = document.querySelector('meta[name="csrf-token"]').content
        http.open('POST', url)
        http.setRequestHeader("Content-Type", "application/json");
        http.setRequestHeader( 'X-CSRF-TOKEN', `${csrftoken}` )

        // console.log(document.getElementsByTagName('meta')['csrf-token'].getAttribute("content") )

        console.log( http)

        // send JSON data to the remote server
        http.send(JSON.stringify(payload))
        http.onload = (res) => {
            if (http.status === 201) {
                data = JSON.parse(http.response)
                console.log(201)
            } else if (http.status === 404) {
                var msg = 'No transaction found';
            }else{
                var msg = 'An error occured, please contact support';
            }
        }
    }

    /* Show the paystack payment popup
     * 
     * source: https://developers.paystack.co/docs/paystack-inline
     */
    function payWithPaystack(validatedemail, amountinkobo, firstname, lastname){
      var handler = PaystackPop.setup({
        key:       public_key,
        email:     validatedemail,
        firstname: firstname,
        lastname:  lastname,
        amount:    amountinkobo,
        ref:       generateREF(), // This uses a random transaction reference based 
                                  // on the time the "Pay" button was clicked.
        callback:  function(response){
          // payment was received
          // clear away the form, show success message
          console.log(response)
          verifyTransaction(response)
          var msg = 'Success. The transaction reference is <b>"' + response.trxref + '"</b>';
          document.getElementById('alert-holder').innerHTML = '<div class="bg-green-200 p-4">' + msg + '</div>';
          document.getElementById("pay-form").reset();
        },
        onClose:  function(){
          // Visitor cancelled payment
          var msg = 'Cancelled. Please click the \'Pay\' button to try again';
          document.getElementById('alert-holder').innerHTML = '<div class="bg-red-200 p-4">' + msg + '</div>';
        }
      });
      handler.openIframe();
    }



    
  </script>

</x-app-layout>


<!-- message
: 
"Approved"
redirecturl
: 
"?trxref=d68d9abb-bf66-4c88-a5fb-a71cafb11861&reference=d68d9abb-bf66-4c88-a5fb-a71cafb11861"
reference
: 
"d68d9abb-bf66-4c88-a5fb-a71cafb11861"
status
: 
"success"
trans
: 
"2169728995"
transaction
: 
"2169728995"
trxref
: 
"d68d9abb-bf66-4c88-a5fb-a71cafb11861" -->