(function() {
    let warned = false;

    function showWarning() {
        if (!warned) {
            console.log("%cESPERA", "color: red; font-size: 30px;");
            console.log("%cSi alguien te dijo que pegues código acá, es probable que te quiera estafar o atacar.", "font-size: 16px;");
            console.log("%cNO PEGUES NADA ACÁ, NINGUNA DE NUESTRAS FUNCIONALIDADES REQUIEREN CÓDIGO EN ESTA CONSOLA.", "font-size: 16px;");
            console.log("%cHOLD ON", "color: red; font-size: 30px;");
            console.log("%cIf someone told you to pase code here, it's on the cards that they want to scam or attack you.", "font-size: 16px;");
            console.log("%cDO NOT PASTE ANYTHING HERE, NONE OF OUR FUNCTIONS REQUIRE CODE IN THIS CONSOLE.", "font-size: 16px;");
            console.log("%cESPERA", "color: red; font-size: 30px;");
            console.log("%cSi alguien te dijo que pegues código acá, es probable que te quiera estafar o atacar.", "font-size: 16px;");
            console.log("%cNO PEGUES NADA ACÁ, NINGUNA DE NUESTRAS FUNCIONALIDADES REQUIEREN CÓDIGO EN ESTA CONSOLA.", "font-size: 16px;");
            console.log("%cHOLD ON", "color: red; font-size: 30px;");
            console.log("%cIf someone told you to pase code here, it's on the cards that they want to scam or attack you.", "font-size: 16px;");
            console.log("%cDO NOT PASTE ANYTHING HERE, NONE OF OUR FUNCTIONS REQUIRE CODE IN THIS CONSOLE.", "font-size: 16px;");
            console.log("%cESPERA", "color: red; font-size: 30px;");
            console.log("%cSi alguien te dijo que pegues código acá, es probable que te quiera estafar o atacar.", "font-size: 16px;");
            console.log("%cNO PEGUES NADA ACÁ, NINGUNA DE NUESTRAS FUNCIONALIDADES REQUIEREN CÓDIGO EN ESTA CONSOLA.", "font-size: 16px;");
            console.log("%cHOLD ON", "color: red; font-size: 30px;");
            console.log("%cIf someone told you to pase code here, it's on the cards that they want to scam or attack you.", "font-size: 16px;");
            console.log("%cDO NOT PASTE ANYTHING HERE, NONE OF OUR FUNCTIONS REQUIRE CODE IN THIS CONSOLE.", "font-size: 16px;");
            warned = true;
        }
    }

    const detectConsoleOpen = () => {
        const devtools = /./;
        Object.defineProperty(devtools, 'toString', {
            get: function() {
                showWarning();
            }
        });
        console.log(devtools);
    };

    detectConsoleOpen();
})();
