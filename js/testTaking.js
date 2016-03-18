/* Test Taking JavaScript - 2/26  Created by Victor Jereza*/
		var counter = 0;
		var testArray = ['What is the meaning of life?',
						     'Why is the Mongolian Horde so awesome?',
						     'Why is Victor such a beast at programming?'];
		
		$(document).ready(function(){
				$("#nxtBtn").click(function(){
			if ((testArray.length-1) == counter)
			{}
			
			else
			{
				$( "#question" ).empty();
				counter++;
				$("#question").append(testArray[counter]);
			}
		});
	});
	
		$(document).ready(function(){
				$("#prevBtn").click(function(){
			 if (counter == 0)
				{}
			 else
			 {
				
			}
		});
	});
		
		/*function loadFirstQuestion()
		{
			 alert("Image is loaded");
			//document.getElementById("question") = testArray[counter];
		
		}*/

// Erases the text area
function eraseText()
{
	document.getElementById("AnswerBox").value="";

}

// Stores the user input
function storeAnswer()
{


}


function loadQuestions(essayArray)
{
	 var essayCloned = 1;
			alert("in load");	 	 
	
	
	
	
	for(i = 0; i < essayArray.length; i += 4)
	{
		$("#essayAnswerBox0").clone.attr('id', 'essayAnswerBox'+ essayCloned).insertAfter($("#essayAnswerBox0"));
		essayCloned++;
	} 
	
}
// Essay questions sections
function loadEssay(essayArray)
{
	
	
}

// Fill in the blank sections
function loadFillInTheBlank()
{
	
}

// True and False section
function loadTrueFalse()
{

}

// Multiple Choice section
function loadMultipleChoice()
{

}

// Matching section
function loadMatching()
{


}

// Short Answer section
function loadShortAnswer()
{


}		