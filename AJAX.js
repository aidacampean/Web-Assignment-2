window.addEventListener('load', function () {
    "use strict";
    const offers = 'getOffers.php';
    const XMLOffer = 'getOffers.php?useXML';

    function offerHTML() {
        fetch(offers)
            .then(
                function (response) {
                    return response.text();
                })
            .then(
                function (data) {
                    console.log(data);
                    document.getElementById("offerHTML").innerHTML = data;
                })
            .catch(
                function (err) {
                    console.log("Something went wrong!", err);
                });
    }

    function offerXML(){
        fetch(XMLOffer)
            .then(
                function (response) {
                    return response.text();
                })
            .then(
                function (data) {
                    console.log(data);
                    let parser = new DOMParser();
                    let xmlDoc = parser.parseFromString(data,"text/xml");
                    let offer = xmlDoc.getElementsByTagName("offer")[0].innerHTML;
                    document.getElementById("offerXML").innerHTML = "<p>" + offer + "</p>";
                })
            .catch(
                function (err) {
                    console.log("Something went wrong!", err);
                });

    }
    offerHTML();
    setInterval(function(){offerHTML()},5000);
    offerXML();


});