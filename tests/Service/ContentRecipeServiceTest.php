<?php

use iTech\Common\Service\APIService;
use iTech\Service\ContentRecipeService;
use PHPUnit\Framework\TestCase;

class ContentRecipeServiceTest extends TestCase
{
    private $returnedRecipesString =
        '{
    "1": {
        "name": "Caramel Pretzel Chocolate Chip Cookies",
        "description": "",
        "servings": "12",
        "thumbnail": "https:\/\/img.buzzfeed.com\/video-api-prod\/assets\/545dd684ec2e4ce1ba12afec4b6dbc59\/BFV15930_CaramelPretzel_ChocolateChipCookies-Thumb1080.jpg",
        "duration": "",
        "ingredients": [
            {
                "name": "all-purpose flour",
                "unit": "cup",
                "quantity": 2,
                "display": "2 cups all-purpose flour"
            },
            {
                "name": "baking soda",
                "unit": "teaspoon",
                "quantity": 1,
                "display": "1 teaspoon baking soda"
            },
            {
                "name": "salt",
                "unit": "teaspoon",
                "quantity": 1,
                "display": "1 teaspoon salt"
            },
            {
                "name": "butter",
                "unit": "cup",
                "quantity": 1,
                "display": "1 cup butter, softened"
            },
            {
                "name": "brown sugar",
                "unit": "cup",
                "quantity": 1,
                "display": "1 cup packed brown sugar"
            },
            {
                "name": "granulated sugar",
                "unit": "cup",
                "quantity": 0,
                "display": "½ cup granulated sugar"
            },
            {
                "name": "vanilla extract",
                "unit": "teaspoon",
                "quantity": 1,
                "display": "2 teaspoons vanilla extract"
            },
            {
                "name": "large egg",
                "unit": "",
                "quantity": 2,
                "display": "4 large eggs"
            },
            {
                "name": "pretzel twist",
                "unit": "cup",
                "quantity": 2,
                "display": "n\/a"
            },
            {
                "name": "chocolate chips",
                "unit": "cup",
                "quantity": 1,
                "display": "1½ cups chocolate chips"
            },
            {
                "name": "caramel candy",
                "unit": "cup",
                "quantity": 1,
                "display": "1½ cups caramel candies, unwrapped"
            }
        ],
        "instructions": {
            "1": {
                "text": "Preheat the oven to 400°F (200°C).",
                "appliance": "oven",
                "temperature": "400"
            },
            "2": {
                "text": "In a medium bowl, whisk together the flour, baking soda, and salt. Set aside.",
                "appliance": "",
                "temperature": ""
            },
            "3": {
                "text": "In a large bowl, beat together the butter, brown sugar, granulated sugar, and vanilla extract until smooth.",
                "appliance": "",
                "temperature": ""
            },
            "4": {
                "text": "Add the eggs, 1 at a time, beating to incorporate before adding the next.",
                "appliance": "",
                "temperature": ""
            },
            "5": {
                "text": "Add the flour mixture a bit at a time while beating, until it forms a smooth dough.",
                "appliance": "",
                "temperature": ""
            },
            "6": {
                "text": "Add the pretzels to a zip-top bag and crush with a rolling pin.",
                "appliance": "",
                "temperature": ""
            },
            "7": {
                "text": "Fold in the chocolate chips and crushed pretzels until evenly combined.",
                "appliance": "",
                "temperature": ""
            },
            "8": {
                "text": "Press a caramel flat and place in the middle of a ball of dough, about 2 tablespoons.",
                "appliance": "",
                "temperature": ""
            },
            "9": {
                "text": "Fold the dough around the caramel, using a bit more to seal if necessary. Place on a well-greased or parchment-lined baking sheet.",
                "appliance": "",
                "temperature": ""
            },
            "10": {
                "text": "Bake for 8-10 minutes, then remove from the oven.",
                "appliance": "",
                "temperature": ""
            },
            "11": {
                "text": "While still warm, press a single pretzel into the top of each cookie. Serve with a cold glass of milk or on their own!",
                "appliance": "",
                "temperature": ""
            },
            "12": {
                "text": "Enjoy!",
                "appliance": "",
                "temperature": ""
            }
        }
    }
}';

    public function testGetRawRecipeContent(): void
    {
        $mock = $this->getMockBuilder(ContentRecipeService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mock->expects($this->once())
            ->method('getRawRecipeContent')
            ->willReturn($this->returnedRecipesString);

        $mockedClass = $this->createMock(APIService::class);
        $mockedClass->method('getContents')
            ->willReturn($this->returnedRecipesString);

        $this->assertEquals($this->returnedRecipesString, $mock->getRawRecipeContent('http://18.130.116.85/recipes', array('from' => 0, 'to' => 1), 'application/x-www-form-urlencoded'));
    }
}