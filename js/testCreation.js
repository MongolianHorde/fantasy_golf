/*Test Creation Javascript Page */

// This is an attempt at creating a class in JavaScript
var Question =
{
   question : "question",
   points   : 0
};



/*
// This is the default constructor for the parent question class
function Default_question()
{
   this.question = "";
   this.points = 0;
}

// This is the generic question class
function Question(question, points)
{
   this.question = question;
   this.points = points;
}

// Gets question
Question.prototype.get_question = function()
{
   return this.question;
}

// Sets question
Question.prototype.set_question = function(question)
{
   this.question = question;
}

// Gets points for question
Question.prototype.get_points = function()
{
   return this.points;
}

// Sets points for question
Question.prototype.set_points = function(points)
{
   this.points = points;
}

// This includes short answer and essay questions (written answers)
function Short_answer(question)
{
   Question.call(this, question);
}

// This includes multiple choice, all that apply, and matching (multiple answers)
function Multiple_choice(question, answer, additional_answers)
{
   Question.call(this, question);
   this.answer = answer;
   this.additional_answers = additional_answers;
}

// Gets multiple choice answer
Multiple_choice.prototype.get_answer = function()
{
   return this.answer;
}

// Sets multiple choice answer
Multiple_choice.prototype.set_answer = function(answer)
{
   this.answer = answer;
}

// Gets multiple choice additional answers
Multiple_choice.prototype.get_additional_answers = function()
{
   return this.additional_answers;
}

// Sets multiple choice additional answers
Multiple_choice.prototype.set_additional_answers = function(answers)
{
   var count = answers.length;
   for (var i = 0; i < count; i++)
   {
      this.additional_answers[i] = answers[i];
   }
}

// This includes true/false (2 answers)
function True_false(question, answer)
{
   Question.call(this, question);
   this.answer = answer;
}

// Gets true/false answer
True_false.prototype.get_answer = function()
{
   return this.answer;
}

// Sets true/false answer
True_false.prototype.set_answer = function(answer)
{
   this.answer = answer;
}

Short_answer.prototype    = Question;
Multiple_choice.prototype = Question;
True_false.prototype      = Question;
*/