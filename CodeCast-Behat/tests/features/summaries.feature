Feature: Summarize CodeCasts
  In order to buy some codecasts
  As a logged in user
  I need to be able to view codecasts summaries

  Rules:
  - Can view a codecast with a VIEWABLE licence
  - Can download a codecast with a DOWNLOADABLE licence
  - Can not do either without any licence

  Scenario: See no codecasts summaries
    Given there is no codecasts available
    And there is a user "U" 
    When "U" log in
    And view the codecasts summaries
    Then there will be 0 codecasts summaries