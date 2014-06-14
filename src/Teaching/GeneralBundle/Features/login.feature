Feature:	login
	Sign in in application
	As user
	Go to home page
Scenario:
	Given Url "/"
	And Username is "emilio"
	And Password is "emilio"
	When I run "login"
	Then I should get:
		"""
		Logueado
		"""