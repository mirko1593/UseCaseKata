Feature: View detail of codeCast
  In order to buy a codeCast
  As a logged in user
  I need to view the codeCast detail

  Scenario: Find a codecast by permalink
    Given there are codecasts:
    | title | publicationDate |
    | Episode 1 | 2017-05-01 |
    | Episode 2 | 2017-07-01 |
    And set permalink 'episode-1' for 'Episode 1'
    And there is a user 'U'
    When 'U' visit the codeCast detail by 'episode-1'
    Then user will see codecast detail:
    | title | publicationDate | description | picture   | viewable | downloadable |
    | Episode 1 | 2017-05-01 | Episode 1    | Episode 1 |  -       | -            |