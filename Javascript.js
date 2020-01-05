window.addEventListener('load', function () {
        "use strict";
        const form = document.getElementById("bookingForm"); //includes all the form content
        const termsText = document.getElementById('termsText'); //includes the terms content
        const termsCheck = termsText.querySelector("[type=checkbox]"); //checkbox from accepting terms

        //for inputCustomerDetails function
        const customerType = document.querySelector("[name=customerType]"); //selects the id for customer type
        const retCustomerDetails = document.getElementById("retCustDetails");//holds customer forename and surname input
        const customerSurname = retCustomerDetails.querySelector("input[name=surname]"); //selects surname input
        const customerForename = retCustomerDetails.querySelector("input[name=forename]");//selects forename input
        const tradeCustomerDetails = document.getElementById("tradeCustDetails"); //holds company name
        const companyName = tradeCustomerDetails.querySelector("input[name=companyName]");//selects company name input

        //for submit function
        const bookNow = document.querySelector("[name=submit]"); //the submit button

        let completeForm = false; //customer details is empty-set to false
        let selectEvent = false; //event not selected-set to false

        //calculate the total of the events
        function calculateTotal() {
                let total = 0; //total is set to 0
                let collectionTotal = 0; //collection total set to 0
                let eventChecked = false; //event not checked
                const items = form.querySelectorAll("div.item"); //get array of events
                const itemsCount = items.length; //get length of the array


                //loops through the events array
                for (let t_i = 0; t_i < itemsCount; t_i++) {
                        const item = items[t_i];
                        const checkbox = item.querySelector("input[data-price][type=checkbox]");

                        if (checkbox.checked) {
                                total = total + parseFloat(checkbox.dataset.price);
                                eventChecked = true;
                        }////changing the text to float so the total can be calculated
                }//end of for

                const radio = form.querySelector("input[data-price][type=radio]");
                if (radio.checked) {
                        collectionTotal = collectionTotal + parseFloat(radio.dataset.price);

                }//changing the text to float so the total can be calculated

                if (eventChecked === true) {
                        selectEvent = true;
                } else {
                        selectEvent = false;
                        bookNow.disabled = true;
                } //if event is selected the submit button is enabled(if other elements are checked too)


                collectionTotal.toFixed(2);
                total.toFixed(2);
                total = collectionTotal + total;
                form.total.value = "£" + total;
        }

        form.total.value = "£" + 0; //total value of items

        //text changing to black when ticked
        function goBlack() {
                if (termsCheck.checked) {
                        termsText.style.color = "black";
                        termsText.style.fontWeight = "normal";
                }
        }

        //text back to red when unticked
        function goRed() {
                if (termsCheck.checked === false) {
                        termsText.style.color = "red";
                        termsText.style.fontWeight = "bold";
                        bookNow.disabled = true;
                }
        }

        //enables submit button when customer details are completed
        function inputCustomerDetails() {
                //changing visibility depending on option selected
                if (customerType.value === "ret") {
                        tradeCustomerDetails.style.visibility = "hidden";
                        retCustomerDetails.style.visibility = "visible";

                        //if customer input completed submit button is enabled
                        if (customerForename.value !== "" && customerSurname.value !== "") {
                                completeForm = true;
                        } else if (customerForename.value === "" || customerSurname.value === "") {
                                completeForm = false;
                                bookNow.disabled = true;
                        }
                }
                //changing visibility depending on option selected
                if (customerType.value === "trd") {
                        tradeCustomerDetails.style.visibility = "visible";
                        retCustomerDetails.style.visibility = "hidden";

                        //if company input completed submit button is enabled
                        if (companyName.value !== "") {
                                completeForm = true;
                        } else if (companyName.value === "") {
                                completeForm = false;
                                bookNow.disabled = true;
                        }
                }
        }

        function submit() {
                if (termsCheck.checked && completeForm === true && selectEvent === true) {
                        bookNow.disabled = false;
                }
        }

        form.addEventListener("change", calculateTotal); //calculates the total
        termsCheck.addEventListener("change", goBlack); //when ticked the terms condition text will turn black and normal font
        termsCheck.addEventListener("change", goRed); //when unticked it will go back to normal
        form.addEventListener("change", inputCustomerDetails);
        form.addEventListener("change", submit);//when terms is checked submit button will be enabled

});