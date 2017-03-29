function naplnCas (){
var datum = new Date(); // prave aktualni cas
aktualniCas = datum.getHours() + "." + datum.getMinutes() + ":" + datum.getSeconds();
// vybral jsem z data, co potrebuju a obalil znamenky, aby se to prevedlo na retezec
window.document.getElementById("cas").innerHTML = aktualniCas;
// vypocitana hodnota se vklada jako html dovnitr elemnetu, ktery ma id "cas"
}

naplnCas(); //naplneni na zacatku
window.setInterval("naplnCas()", 1000); //pravidelna zmena, 1000 je sekunda