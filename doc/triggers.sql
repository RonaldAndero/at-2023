CREATE TRIGGER results_deleted
BEFORE DELETE ON results
FOR EACH ROW
INSERT INTO results_log
SET result_id = OLD.result_id,
theoretical_points = OLD.theoretical_points,
user_id = OLD.user_id,
practical_errors = OLD.practical_errors,
practical_points = OLD.practical_points,
nr_of_questions = OLD.nr_of_questions,
firstname = (SELECT firstname FROM results INNER JOIN users ON results.user_id = users.user_id WHERE results.user_id = OLD.user_id),
lastname = (SELECT lastname FROM results INNER JOIN users ON results.user_id = users.user_id WHERE results.user_id = OLD.user_id),
date = OLD.date;