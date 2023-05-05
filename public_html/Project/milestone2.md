<table><tr><td> <em>Assignment: </em> IT202 Milestone 2 Bank Project</td></tr>
<tr><td> <em>Student: </em> Grimm Cato (gc359)</td></tr>
<tr><td> <em>Generated: </em> 5/5/2023 12:25:30 AM</td></tr>
<tr><td> <em>Grading Link: </em> <a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-008-S23/it202-milestone-2-bank-project/grade/gc359" target="_blank">Grading</a></td></tr></table>
<table><tr><td> <em>Instructions: </em> <ol><li>Checkout Milestone2 branch</li><li>Create a new markdown file called milestone2.md</li><li>git add/commit/push immediate</li><li>Fill in the below deliverables</li><li>At the end copy the markdown and paste it into milestone2.md</li><li>Add/commit/push the changes to Milestone2</li><li>PR Milestone2 to dev and verify</li><li>PR dev to prod and verify</li><li>Checkout dev locally and pull changes to get ready for Milestone 3</li><li>Submit the direct link to this new milestone2.md file from your GitHub prod branch to Canvas</li></ol><p>Note: Ensure all images appear properly on github and everywhere else. Images are only accepted from dev or prod, not local host. All website links must be from prod (you can assume/infer this by getting your dev URL and changing dev to prod).</p></td></tr></table>
<table><tr><td> <em>Deliverable 1: </em> Create Accounts table and setup </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a screenshot from the db of the system user (Users table)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/113853920/236369090-424d1c94-031c-44bc-aba3-3bcc92a5d74b.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Clearly show/caption which is the system user (should not be a real user,<br>password should not be a valid password/hash)<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot from the db of the world account (Accounts table)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/113853920/236369312-82274ed3-7dad-407a-a265-6e4c1d4db73e.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Clearly show/caption which is the world account (should have account number 000000000000, should<br>be of type world, should be associated with the system user)<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Explain the purpose and usage of these two entries and how they relate</td></tr>
<tr><td> <em>Response:</em> <p>For verification, summing the src and dest should equal to the account balance<br></p><br></td></tr>
<tr><td> <em>Sub-Task 4: </em> Add related pull request link(s)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/gc359/IT202-008/pull/31">https://github.com/gc359/IT202-008/pull/31</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 2: </em> Dashboard </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a screenshot showing the requested links/navigation</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/113853920/236369599-012f9cc3-a081-4b9a-bc1e-8e41fac96f20.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Links in the navbar don&#39;t count (it&#39;s ok if some are duplicated here<br>and navbar)<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explain which ones are working for this milestone</td></tr>
<tr><td> <em>Response:</em> <p>The links work and it can direct you to the following pages:<br><ol><li>deposit</li><li>transfer</li><li>withdraw</li><li>transaction history</li></ol><br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add related pull request link(s)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/gc359/IT202-008/pull/33">https://github.com/gc359/IT202-008/pull/33</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 3: </em> Create a checking Account </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a screenshot showing the Create Account Page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/113853920/236369943-00bec0b8-d2f4-4365-90e4-d8c002a55420.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>I made a button that will create a checking account for you<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add screenshots showing validation errors and success message</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/113853920/236370118-33123297-7097-48c0-8cd2-126daf3b6569.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Show the success message from task 1&#39;s data<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add a screenshot showing the transaction generated from the initial deposit (from the DB)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/113853920/236370228-ecf4a7a9-684e-4bb8-8a1b-d8b8ec2b8ef6.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Clearly highlight or mention in the caption which to look at. There should<br>be two records showing the positive and negative movement of funds between accounts<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 4: </em> Explain which account number generation you used and the account creation process including the transaction logic</td></tr>
<tr><td> <em>Response:</em> <ol><li>I used a substringmethod to generate a random 12 digit/character value</li><li>&nbsp;steps in account<br>creation:</li></ol><ul><li>&nbsp;Insert the new account into the Accounts table<br></li><li>// Get the ID of the<br>newly created account<br></li><li>Insert a transaction record for the initial deposit<br></li><li>// Commit the transaction<br></li><li>//<br>Redirect the user to their Accounts page<br></li></ul><br></td></tr>
<tr><td> <em>Sub-Task 5: </em> Add related pull request link(s)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/gc359/IT202-008/pull/37">https://github.com/gc359/IT202-008/pull/37</a> </td></tr>
<tr><td> <em>Sub-Task 6: </em> Add a direct link to heroku prod for this file</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://gc359-prod.herokuapp.com/Project/login.php">https://gc359-prod.herokuapp.com/Project/login.php</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 4: </em> User will be able to list their accounts </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a screenshot showing the user's account list view (show 5 accounts)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/113853920/236370712-b42bf74c-827b-49a7-8e3a-2c3ff04fbfe0.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>There should be at least 5,Show account number, account type, modified, and balance,<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Briefly explain how the page is displayed and the data lookup occurs</td></tr>
<tr><td> <em>Response:</em> <p><span style="color: rgb(209, 213, 219); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto,<br>Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI<br>Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; white-space: pre-wrap; background-color: rgb(68,<br>70, 84);">The my_accounts.php file displays tvhe list of accounts belonging to the currently<br>logged-in user, with details such as account number, account type, last modified time,<br>and balance. It also provides a link to view transaction history for each<br>account and a button to create a new account. </span><br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add related pull request link(s)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/gc359/IT202-008/pull/39">https://github.com/gc359/IT202-008/pull/39</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Add a direct link to heroku prod for this file</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://gc359-prod.herokuapp.com/Project/my_accounts.php">https://gc359-prod.herokuapp.com/Project/my_accounts.php</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 5: </em> Account Transaction Details </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a screenshot of an account's transaction history</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/113853920/236375131-5a4f20f9-a141-4e84-8824-6024ed8b294f.png"/></td></tr>
<tr><td> <em>Caption:</em> <pre><code>Account: Show account number, account type, balance, opened/created date of the selected account&lt;br&gt;(from Accounts table)&lt;br&gt;
</code></pre>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explain how the lookup and display occurs</td></tr>
<tr><td> <em>Response:</em> <p>There are two db queries, one for the accounts, and one from the<br>transactions table<br><br>my_accounts.php uses the accounts table while transaction_history.php uses the transaction table<br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add related pull request link(s)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/gc359/IT202-008/pull/41">https://github.com/gc359/IT202-008/pull/41</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Add a direct link to heroku prod for this file</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://gc359-prod.herokuapp.com/Project/transaction_history.php?account_id=32">https://gc359-prod.herokuapp.com/Project/transaction_history.php?account_id=32</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 6: </em> Deposit/Withdraw </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Show a Screenshot of the Deposit Page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/113853920/236376334-cfa9d14b-9541-409b-bee6-d6aab7b68e8a.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Show valid data filled in to the form before submit<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Show a Screenshot of the Withdraw Page (this potentially can be the same page with different views)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/113853920/236376412-01a905d1-05ef-413b-abe8-7c28eb9a6bc7.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>age should include a dropdown of logged in user&#39;s accounts and their balances<br>and a text field to add the desired amount to withdraw<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Show validation error for negative numbers</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/113853920/236376498-94e8b24f-3596-4385-a883-e9a5c39a5b39.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>validation<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 4: </em> Show validation error for withdrawing more than the account contains</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/113853920/236376609-3a877a05-69cb-40c3-b2f6-0f196f786d4c.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>error when not enough b<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 5: </em> Show a success message for deposit and withdraw (2 screenshots)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/113853920/236376787-2e8cf978-ba27-4ea7-b64d-77cde609b329.png"/></td></tr>
<tr><td> <em>Caption:</em> <pre><code>Shows withdraw success&lt;br&gt;
</code></pre>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/113853920/236376884-fee8cb02-8860-4c63-8f46-162a30a21b13.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Shows deposit success<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 6: </em> Show a screenshot of the transaction pairs in the DB for the above tests</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/113853920/236377003-950246e4-82bd-44fe-bec3-618472187389.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Highlight or mention in caption which records to look at<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 7: </em> Briefly explain how transactions work</td></tr>
<tr><td> <em>Response:</em> <p>The src and dest work together in tandem to give an accurate balance.<br>There will always be pairs in the transaction history to verify all withdrawals<br>and deposits<br></p><br></td></tr>
<tr><td> <em>Sub-Task 8: </em> Add related pull request link(s)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/gc359/IT202-008/pull/43">https://github.com/gc359/IT202-008/pull/43</a> </td></tr>
<tr><td> <em>Sub-Task 9: </em> Add a direct link to heroku prod for this file</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://gc359-prod.herokuapp.com/Project/deposit.php">https://gc359-prod.herokuapp.com/Project/deposit.php</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 7: </em> Misc </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots showing which issues are done/closed (project board) </td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/113853920/236377296-8f339623-cac0-4e5f-a843-e029a641f286.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>first 4 parts of milestone2 all complete<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/113853920/236377398-19bb3ef4-2be3-465d-93da-f145b6d44a22.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>last 3 parts of milestone2 completed and displayed on project board<br></p>
</td></tr>
</table></td></tr>
</table></td></tr>
<table><tr><td><em>Grading Link: </em><a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-008-S23/it202-milestone-2-bank-project/grade/gc359" target="_blank">Grading</a></td></tr></table>