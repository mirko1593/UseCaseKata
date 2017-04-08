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

  Scenario: See viewable codecasts summaries
    Given there are codecasts:
    | title | publicationDate |
    | Episode 1 | 2017-05-01 |
    | Episode 2 | now |
    And there is a user 'U'
    And there is a 'VIEWABLE' licence for 'U' to view 'Episode 1'
    When 'U' log in
    And view the codecasts summaries
    Then the codecasts summaries will be:
    | title | publicationDate | viewable | downloadable |
    | Episode 1 | 2017-05-01 | + | - |
    | Episode 2 | 2017-04-08 | - | - |

