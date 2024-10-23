var checkbox = document.getElementById('customSwitch1');
var delivery_divEtudiant = document.getElementById('delivery');
checkbox.onclick = function() {
    console.log(this);
    if (this.checked) {
        delivery_divEtudiant.style['display'] = 'block';
    } else {
        delivery_divEtudiant.style['display'] = 'none';
    }
};

var checkbox = document.getElementById('customSwitch2');
var delivery_divEnseignant = document.getElementById('FormEnseignant');
checkbox.onclick = function() {
    console.log(this);
    if (this.checked) {
        delivery_divEnseignant.style['display'] = 'block';
    } else {
        delivery_divEnseignant.style['display'] = 'none';
    }
};