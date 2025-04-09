<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foods = [
            // MainCourse
            ['name' => 'Beef Wellington', 'category_id' => 1, 'description' => 'A delicious steak dish wrapped in puff pastry.', 'price' => 850, 'image' => 'https://images.pexels.com/photos/11267449/pexels-photo-11267449.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Chicken Parmesan', 'category_id' => 1, 'description' => 'Crispy chicken breast with marinara and cheese.', 'price' => 550, 'image' => 'https://images.pexels.com/photos/21821602/pexels-photo-21821602/free-photo-of-pasta-on-plate.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Grilled Salmon', 'category_id' => 1, 'description' => 'Fresh salmon grilled to perfection.', 'price' => 600, 'image' => 'https://images.pexels.com/photos/5531039/pexels-photo-5531039.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Roast Duck', 'category_id' => 1, 'description' => 'Juicy roast duck served with plum sauce.', 'price' => 700, 'image' => 'https://images.pexels.com/photos/18015003/pexels-photo-18015003/free-photo-of-cut-beef-with-sauce-and-vegetables.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Steak Frites', 'category_id' => 1, 'description' => 'Steak served with crispy fries.', 'price' => 750, 'image' => 'https://images.unsplash.com/photo-1575900365671-6b67e2265d98?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
            ['name' => 'Lamb Chops', 'category_id' => 1, 'description' => 'Tender lamb chops grilled with herbs.', 'price' => 800, 'image' => 'https://images.pexels.com/photos/323682/pexels-photo-323682.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Pork Belly', 'category_id' => 1, 'description' => 'Crispy pork belly with sweet soy glaze.', 'price' => 500, 'image' => 'https://images.unsplash.com/photo-1624174782964-e541742299ee?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
            ['name' => 'Vegetable Lasagna', 'category_id' => 1, 'description' => 'Layers of veggies, pasta, and cheese.', 'price' => 450, 'image' => 'https://images.unsplash.com/photo-1739790397103-f1736c44235a?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
            ['name' => 'Curry Goat', 'category_id' => 1, 'description' => 'Spicy goat curry with rice.', 'price' => 650, 'image' => 'https://cdn.pixabay.com/photo/2022/06/07/20/52/curry-7249243_1280.jpg'],
            ['name' => 'Fish Tacos', 'category_id' => 1, 'description' => 'Crunchy tacos filled with spicy fish.', 'price' => 350, 'image' => 'https://images.unsplash.com/photo-1604467715878-83e57e8bc129?q=80&w=1976&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],


            // Appetizer
            ['name' => 'Bruschetta', 'category_id' => 2, 'description' => 'Toasted bread with tomato and basil.', 'price' => 250, 'image' => 'https://plus.unsplash.com/premium_photo-1677686707252-16013f466e61?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
            ['name' => 'Mozzarella Sticks', 'category_id' => 2, 'description' => 'Fried cheese with marinara sauce.', 'price' => 200, 'image' => 'https://images.unsplash.com/photo-1734774924912-dcbb467f8599?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
            ['name' => 'Stuffed Mushrooms', 'category_id' => 2, 'description' => 'Mushrooms filled with cheese and herbs.', 'price' => 220, 'image' => 'https://images.pexels.com/photos/5950441/pexels-photo-5950441.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Spring Rolls', 'category_id' => 2, 'description' => 'Crispy rolls with veggie filling.', 'price' => 180, 'image' => 'https://images.pexels.com/photos/29714345/pexels-photo-29714345/free-photo-of-fresh-spring-rolls-on-wooden-table.jpeg?auto=compress&cs=tinysrgb&w=600'],
            ['name' => 'Deviled Eggs', 'category_id' => 2, 'description' => 'Hard-boiled eggs with seasoned yolks.', 'price' => 150, 'image' => 'https://images.unsplash.com/photo-1623031843775-11ef477a7724?q=80&w=1935&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
            ['name' => 'Shrimp Cocktail', 'category_id' => 2, 'description' => 'Chilled shrimp with cocktail sauce.', 'price' => 300, 'image' => 'https://images.unsplash.com/photo-1691201659377-978b28daa417?q=80&w=1935&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
            ['name' => 'Onion Rings', 'category_id' => 2, 'description' => 'Golden fried onion rings.', 'price' => 190, 'image' => 'https://images.unsplash.com/photo-1639024471283-03518883512d?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
            ['name' => 'Potato Skins', 'category_id' => 2, 'description' => 'Loaded potato skins with cheese and bacon.', 'price' => 210, 'image' => 'https://images.pexels.com/photos/17461583/pexels-photo-17461583/free-photo-of-roasted-potatoes-scallion-and-sour-cream-on-a-porcelain-plate.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Caprese Skewers', 'category_id' => 2, 'description' => 'Tomato, mozzarella, and basil on a stick.', 'price' => 200, 'image' => 'https://plus.unsplash.com/premium_photo-1677619680397-434ff4997c34?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
            ['name' => 'Cheese Platter', 'category_id' => 2, 'description' => 'Assorted cheeses with crackers.', 'price' => 350, 'image' => 'https://images.pexels.com/photos/1200354/pexels-photo-1200354.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],


            // Side Dish
            ['name' => 'Garlic Mashed Potatoes', 'category_id' => 3, 'description' => 'Creamy potatoes with garlic.', 'price' => 150, 'image' => 'https://images.pexels.com/photos/6262162/pexels-photo-6262162.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Steamed Vegetables', 'category_id' => 3, 'description' => 'Mixed veggies lightly steamed.', 'price' => 120, 'image' => 'https://images.unsplash.com/photo-1592578630143-fac65cda7a67?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
            ['name' => 'Corn on the Cob', 'category_id' => 3, 'description' => 'Grilled corn with butter.', 'price' => 100, 'image' => 'https://images.pexels.com/photos/16821504/pexels-photo-16821504/free-photo-of-close-up-of-baked-corn.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Rice Pilaf', 'category_id' => 3, 'description' => 'Fluffy rice with herbs.', 'price' => 130, 'image' => 'https://images.pexels.com/photos/19120336/pexels-photo-19120336/free-photo-of-rice-served-in-a-restaurant.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Coleslaw', 'category_id' => 3, 'description' => 'Cabbage salad with mayo dressing.', 'price' => 90, 'image' => 'https://images.pexels.com/photos/1633526/pexels-photo-1633526.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Sweet Potato Fries', 'category_id' => 3, 'description' => 'Crispy sweet potato fries.', 'price' => 140, 'image' => 'https://images.pexels.com/photos/1893556/pexels-photo-1893556.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Mac and Cheese', 'category_id' => 3, 'description' => 'Cheesy pasta goodness.', 'price' => 160, 'image' => 'https://images.pexels.com/photos/806357/pexels-photo-806357.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Baked Beans', 'category_id' => 3, 'description' => 'Savory slow-cooked beans.', 'price' => 110, 'image' => 'https://plus.unsplash.com/premium_photo-1669655027790-ce16e29405c9?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
            ['name' => 'Garlic Bread', 'category_id' => 3, 'description' => 'Toasted bread with garlic butter.', 'price' => 100, 'image' => 'https://images.pexels.com/photos/1718446/pexels-photo-1718446.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Fried Plantains', 'category_id' => 3, 'description' => 'Sweet fried plantain slices.', 'price' => 120, 'image' => 'https://images.unsplash.com/photo-1676700310614-600f2aa255ef?q=80&w=1926&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],


            // Salads
            ['name' => 'Caesar Salad', 'category_id' => 4, 'description' => 'Romaine lettuce with Caesar dressing.', 'price' => 320, 'image' => 'https://images.pexels.com/photos/2097090/pexels-photo-2097090.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Greek Salad', 'category_id' => 4, 'description' => 'Feta cheese, olives, cucumber.', 'price' => 340, 'image' => 'https://images.pexels.com/photos/1211887/pexels-photo-1211887.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Garden Salad', 'category_id' => 4, 'description' => 'Mixed greens with veggies.', 'price' => 300, 'image' => 'https://images.pexels.com/photos/13159772/pexels-photo-13159772.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Pasta Salad', 'category_id' => 4, 'description' => 'Cold pasta with Italian dressing.', 'price' => 310, 'image' => 'https://images.pexels.com/photos/803963/pexels-photo-803963.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Fruit Salad', 'category_id' => 4, 'description' => 'Assorted fresh fruits.', 'price' => 290, 'image' => 'https://images.pexels.com/photos/1546896/pexels-photo-1546896.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Tuna Salad', 'category_id' => 4, 'description' => 'Tuna mixed with mayo and greens.', 'price' => 330, 'image' => 'https://images.pexels.com/photos/8983407/pexels-photo-8983407.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Asian Slaw', 'category_id' => 4, 'description' => 'Crunchy slaw with Asian dressing.', 'price' => 310, 'image' => 'https://images.pexels.com/photos/2764885/pexels-photo-2764885.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Chickpea Salad', 'category_id' => 4, 'description' => 'Chickpeas, tomatoes, and herbs.', 'price' => 320, 'image' => 'https://images.pexels.com/photos/6066051/pexels-photo-6066051.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Quinoa Salad', 'category_id' => 4, 'description' => 'Healthy quinoa with veggies.', 'price' => 350, 'image' => 'https://images.pexels.com/photos/31235446/pexels-photo-31235446/free-photo-of-colorful-gourmet-cuisine-with-fresh-ingredients.jpeg?auto=compress&cs=tinysrgb&w=600'],
            ['name' => 'Caprese Salad', 'category_id' => 4, 'description' => 'Tomatoes, mozzarella, and basil.', 'price' => 340, 'image' => 'https://images.pexels.com/photos/15735983/pexels-photo-15735983/free-photo-of-caprese-salad-on-a-plate.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],


            // Soups
            ['name' => 'Tomato Soup', 'category_id' => 5, 'description' => 'Classic creamy tomato soup.', 'price' => 220, 'image' => 'https://images.pexels.com/photos/3493579/pexels-photo-3493579.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Chicken Noodle Soup', 'category_id' => 5, 'description' => 'Comforting chicken and noodles.', 'price' => 240, 'image' => 'https://images.pexels.com/photos/30392957/pexels-photo-30392957/free-photo-of-delicious-chicken-noodle-soup-in-white-bowl.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'French Onion Soup', 'category_id' => 5, 'description' => 'Rich onion soup with melted cheese.', 'price' => 260, 'image' => 'https://images.pexels.com/photos/11865617/pexels-photo-11865617.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Clam Chowder', 'category_id' => 5, 'description' => 'Creamy soup with clams and potatoes.', 'price' => 280, 'image' => 'https://images.pexels.com/photos/30649002/pexels-photo-30649002/free-photo-of-steamed-mussels-with-lemon-and-herbs.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Minestrone', 'category_id' => 5, 'description' => 'Italian vegetable soup.', 'price' => 250, 'image' => 'https://images.unsplash.com/photo-1611068120813-eca5a8cbf793?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
            ['name' => 'Miso Soup', 'category_id' => 5, 'description' => 'Japanese broth with tofu and seaweed.', 'price' => 230, 'image' => 'https://images.pexels.com/photos/30682816/pexels-photo-30682816/free-photo-of-traditional-japanese-miso-soup-with-salmon.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Pumpkin Soup', 'category_id' => 5, 'description' => 'Creamy spiced pumpkin soup.', 'price' => 240, 'image' => 'https://images.pexels.com/photos/209540/pexels-photo-209540.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Corn Soup', 'category_id' => 5, 'description' => 'Sweet corn soup with cream.', 'price' => 210, 'image' => 'https://plus.unsplash.com/premium_photo-1668143364104-b8fe599d835e?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
            ['name' => 'Lentil Soup', 'category_id' => 5, 'description' => 'Hearty soup with lentils.', 'price' => 230, 'image' => 'https://images.pexels.com/photos/6120506/pexels-photo-6120506.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Beef Barley Soup', 'category_id' => 5, 'description' => 'Soup with beef chunks and barley.', 'price' => 270, 'image' => 'https://images.pexels.com/photos/1731535/pexels-photo-1731535.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],


            // Desserts
            ['name' => 'Chocolate Cake', 'category_id' => 6, 'description' => 'Rich and moist chocolate cake.', 'price' => 200, 'image' => 'https://images.pexels.com/photos/2067396/pexels-photo-2067396.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Cheesecake', 'category_id' => 6, 'description' => 'Creamy cheesecake with crust.', 'price' => 220, 'image' => 'https://images.pexels.com/photos/3185509/pexels-photo-3185509.png?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Apple Pie', 'category_id' => 6, 'description' => 'Classic apple pie with cinnamon.', 'price' => 180, 'image' => 'https://images.pexels.com/photos/6163264/pexels-photo-6163264.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Tiramisu', 'category_id' => 6, 'description' => 'Coffee-flavored Italian dessert.', 'price' => 240, 'image' => 'https://images.pexels.com/photos/29721415/pexels-photo-29721415/free-photo-of-elegant-tiramisu-cake-with-ladyfingers.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Ice Cream Sundae', 'category_id' => 6, 'description' => 'Scoop of ice cream with toppings.', 'price' => 150, 'image' => 'https://images.pexels.com/photos/2586924/pexels-photo-2586924.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Brownies', 'category_id' => 6, 'description' => 'Fudgy chocolate brownies.', 'price' => 190, 'image' => 'https://images.pexels.com/photos/2373520/pexels-photo-2373520.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Banana Split', 'category_id' => 6, 'description' => 'Banana with scoops of ice cream.', 'price' => 210, 'image' => 'https://images.pexels.com/photos/5570887/pexels-photo-5570887.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Creme Brulee', 'category_id' => 6, 'description' => 'Caramelized custard dessert.', 'price' => 230, 'image' => 'https://images.pexels.com/photos/9957548/pexels-photo-9957548.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Lava Cake', 'category_id' => 6, 'description' => 'Chocolate cake with molten center.', 'price' => 220, 'image' => 'https://images.pexels.com/photos/27819687/pexels-photo-27819687/free-photo-of-a-chocolate-pudding-with-ice-cream-on-top.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Panna Cotta', 'category_id' => 6, 'description' => 'Creamy dessert with fruit topping.', 'price' => 210, 'image' => 'https://images.pexels.com/photos/14732341/pexels-photo-14732341.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],


            // Beverages
            ['name' => 'Iced Tea', 'category_id' => 7, 'description' => 'Refreshing cold tea.', 'price' => 80, 'image' => 'https://images.pexels.com/photos/1484678/pexels-photo-1484678.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Lemonade', 'category_id' => 7, 'description' => 'Sweet and tangy lemon drink.', 'price' => 90, 'image' => 'https://images.pexels.com/photos/2109099/pexels-photo-2109099.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Soda', 'category_id' => 7, 'description' => 'Carbonated soft drink.', 'price' => 60, 'image' => 'https://images.pexels.com/photos/2775860/pexels-photo-2775860.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Coffee', 'category_id' => 7, 'description' => 'Hot brewed coffee.', 'price' => 100, 'image' => 'https://images.pexels.com/photos/312418/pexels-photo-312418.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Milkshake', 'category_id' => 7, 'description' => 'Creamy milk and ice cream blend.', 'price' => 120, 'image' => 'https://images.pexels.com/photos/103566/pexels-photo-103566.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Orange Juice', 'category_id' => 7, 'description' => 'Freshly squeezed orange juice.', 'price' => 110, 'image' => 'https://images.pexels.com/photos/1194028/pexels-photo-1194028.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Smoothie', 'category_id' => 7, 'description' => 'Fruit blended drink.', 'price' => 130, 'image' => 'https://images.pexels.com/photos/4112870/pexels-photo-4112870.png?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Hot Chocolate', 'category_id' => 7, 'description' => 'Warm chocolate drink.', 'price' => 110, 'image' => 'https://images.pexels.com/photos/3551717/pexels-photo-3551717.png?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Water', 'category_id' => 7, 'description' => 'Chilled mineral water.', 'price' => 50, 'image' => 'https://images.pexels.com/photos/928854/pexels-photo-928854.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
            ['name' => 'Iced Coffee', 'category_id' => 7, 'description' => 'Chilled coffee with ice.', 'price' => 120, 'image' => 'https://images.pexels.com/photos/2615323/pexels-photo-2615323.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'],
        ];

        foreach ($foods as $food) {
            Food::create($food);
        }
    }
}
