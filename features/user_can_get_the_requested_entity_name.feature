Feature: User can get the requested entity name
  In order to display the entity information
  As a user
  I need to be able to get the entity name

  Scenario: User gets the name for the requested entity
    Given there is an entity with this information:
      | Id   | 123         |
      | Name | Entity name |
    When I request the name for the entity 123
    Then I should get "Entity name" back

  Scenario: User gets an exception if he requested a non-existing entity
    Given the entity 456 does not exists
    When I request the name for the entity 456
    Then I should get an exception
