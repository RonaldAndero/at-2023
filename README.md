Aasta Tegija 2017
===
Online HTML/CSS test environment for Tartu Vocational Education Centre that
won first place in school competition. This project uses 
[Halo PHP framework](https://github.com/henno/halo).

Overview
------
#### Client side
Client side starts with the welcome view, which introduces the test. From there
the user can login using their credentials and PIN given by the teacher. Social id is validated using
[Isikukood.js](https://github.com/dknight/Isikukood-js). The test starts with theoretical quiz 
(the number of questions are assigned in back-end settings). The questions and the question answers 
are shuffled randomly and stored in the users session. The second part is the practical test which is 
also assigned randomly and stored in the users session. Depending on the back end settings, 
the live code preview iframe is hidden or visible. The textarea uses 
[CodeMirror](https://github.com/codemirror/CodeMirror) text editor. 
After practical test the user is presented with their submitted practical assignment
(iframe) and they can finish the test. The last view shows their theoretical test result
and they will be redirected to homepage automatically after 15 seconds. This test also features
automatic redirection when user tries to go back. If a user should close the browser they can login
again and they will be redirected to where they left off. After redirection, user can see public results, depending on
the backend settings.

#### Admin side
Admin side starts with the result page view, where potential students are lined up by their results ASC. Also, it is 
shown whether the potential student has registered to the test. It is possible to allow potential student to take the
test several times. After test trials the results table is deleted and information is updated to log table. 
Second page is about editing, adding and deleting practical questions.
Third page is about editing, adding and deleting theoretical questions. It is possible to search theoretical questions by
keywords. Also, when adding questions, all fields have to be filled. 
After third page comes practical test grading, where admin can rate potential stundents from 0 to 10. All the potential
student's written code is available to see and judge. It is possible to see html errors, if the admin settings are
adjusted accordingly.
Fifth page is about log table, which maintains all the deleted results from the results page results table. For more 
effective usage, it is possible to sort information by different parameters. However, by default it sorts information 
by date ASC.
After log page comes admin settings page, where's possible to change the number of theoretical questions for client's
side. Admin can generate PIN and open the user test from 2 to 8 hours. It is possible to turn on and off html validation 
W3C API, change user's practical test online code view. To hide public results in welcome page, to change admin
password.
And the last page is about admin side operating instruction.

