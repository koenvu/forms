Getting started with Forms is simple: include `koenvu/forms` in your composer file.

The `Form` base class provided in the package is designed to work with Laravel, however this is not required. The `Form` class allows you to add fields that conform to the `FormElement` contract. This contract is easily implemented by using the `Elementary` trait. Lastly the `Valuable` trait is a sample on how to add more standard functionality to the `Form` class.

The idea is to have a solid base that can be easily and fully extended in your application. The main goal is to provide an easy way to create HTML views and style them in different ways.