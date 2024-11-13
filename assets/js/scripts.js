document.addEventListener("DOMContentLoaded", function () {

    document.getElementById("parserForm").addEventListener("submit", function (event) {
        event.preventDefault();
        const formData = new FormData(this);

        fetch('index.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                document.getElementById('resultTable').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
    });

    document.getElementById("clearButton").addEventListener("click", function () {
        document.getElementById("parserForm").reset();
        document.getElementById("resultTable").innerHTML = "";

        fetch("clear.php", { method: "POST" })
            .then(() => console.log("Cleared"))
            .catch(error => console.error("Error:", error));
    });

    window.addEventListener("beforeunload", function (event) {
        event.preventDefault();
        event.returnValue = "Are you sure?";
    });
});
