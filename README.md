There are a lot of thing left that should be completed:
1. Proper installation of composer.json to needed folders, so all namespaces with custom naming would autoload (cool feature for making packages)
2. Making service providers and proper DI
3. Unit test sometimes are really redundant because they took only one small piece of whole system - spending time for making a test to see the result of "10 * 100" sometimes consumes necessary human resources
4. Proper work with external services -> API wrapper that makes calls -> Mapper -> Public Contract -> InternalService


I hope you'll like my attempt to refactor/rewrite this code. There are a lot of ideas how to improve this.

P.S vendor is not there because by the default Laravel install ALL possible features and libraries to satisfy the dev, there were ~3GB :`)
