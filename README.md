# UseCaseKata
Some Kata About Use Case Driven Approach, and No Framework will be involved. 

### CodeCast
> CodeCast is an experiment on UseCase Driven Approach based on Uncle Bob's Java Case Study.

##### CodeCast has two UseCases
1.  CodeCastSummariesUseCase
    - Dir: src/UseCases/CodeCastSummaries
    - Role:
        - UseCase/InputBoundaryImpl: CodeCastSummariesUseCase
        - InputBoundary:  CodeCastSummariesInputBoundary
        - OutputBoundary: CodeCastSummariesOutputBoundary
        - OutputBoundaryImpl: CodeCastSummariesPresenter
        - ResponseModel: CodeCastSummariesResponseModel
        - Sub-ResponseModle: CodeCastSummary
        - ViewModel:  CodeCastSummariesViewModel
        - Sub-ViewModel: ViewCodeCastSummary
    - Entity:
        - Real Model
        - CodeCast
        - User
        - Licence
    - tests/fixture:
        - Some Trait, plan to implement scenario in Fitness.
        - Similar to Step Definition in Behat
        - Will be used as a comparsion to Behat Implemented.(For later re-implementation).
2.  CodeCastDetailUseCase