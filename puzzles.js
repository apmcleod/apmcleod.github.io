let puzzleAnswers = new Map();
puzzleAnswers.set("11", "AMALGAMATE");
puzzleAnswers.set("12", "COPPER EXCHANGE");
puzzleAnswers.set("13", "RARE METAL");
puzzleAnswers.set("14", "CHALLENGE");
puzzleAnswers.set("21", "HORSEPOWER");
puzzleAnswers.set("22", "JULIET");
puzzleAnswers.set("23", "DOCTOR");
puzzleAnswers.set("24", "WELCOME TO THE JUNGLE");
puzzleAnswers.set("25", "DAUGHTER");
puzzleAnswers.set("26", "JANUS");
puzzleAnswers.set("27", "SHETLAND");

let keepGoing = new Map();
keepGoing.set("11", ["ONE IS A DENTAL MIXTURE"]);
keepGoing.set("21", ["ENGINE UNIT"]);
keepGoing.set("23", ["EYE STRANGE", "EYE STRANGE SIX"]);
keepGoing.set("24", ["GNRS HELLO"]);
keepGoing.set("24", ["RELATE TV OMG SAYER TO ROMAN GOD"]);


function equivalent(str1, str2) {
    str1 = str1.replace(/[^a-zA-Z]/g, '');
    str2 = str2.replace(/[^a-zA-Z]/g, '');

    return str1.toUpperCase() === str2.toUpperCase();
}

function checkAnswer(puzzleId) {
    var toCheck = document.getElementById("input-" + puzzleId).value;
    console.log("Checking answer " + toCheck);

    var outputElement = document.getElementById("check-result-" + puzzleId);
    var output = "❌";

    if (equivalent(toCheck, puzzleAnswers.get(puzzleId))) {
        // Correct
        output = "✅";

    } else if (keepGoing.has(puzzleId)) {
        var keepGoingList = keepGoing.get(puzzleId);

        for (var i = 0; i < keepGoingList.length; i++) {
            if (equivalent(keepGoingList[i], toCheck)) {
                // Keep Going
                output = "Keep Going!";
            }
        }
    }

    // Incorrect
    outputElement.innerHTML = output;
}

var puzzleIds = ["11", "12", "13", "14", "21", "22", "23", "24", "25", "26", "27"];
for (var i = 0; i < puzzleIds.length; i++) {
    document.getElementById("input-" + puzzleIds[i]).addEventListener(
        "keydown",
        function (event) {
            if (event.key === "Enter") {
                document.getElementById("check-button-" + this.id.split("-")[1]).click();
            }
        }
    );
}
