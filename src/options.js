downloadList = [
    {name: "Honey Core", target: "HoneyCore.jar"},
] 

const elements = document.getElementById('downloads');
for (let i = 0; i < downloadList.length; i++) {
    const optionElement = document.createElement('option');
    optionElement.value = downloadList[i].target;
    optionElement.text = downloadList[i].name;
    elements.appendChild(optionElement);
}
