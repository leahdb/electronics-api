<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seed_product_categories();
        $this->seed_products();
        $this->seed_blogs();
    }

    private function seed_blogs()
    {
        $blogsData = [
                [
                    'image' => 'https://images.pexels.com/photos/18268400/pexels-photo-18268400/free-photo-of-dogs-in-cage-in-shelter.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'title' => 'Exploring Pet Shelters in the UAE',
                    'slug' => 'exploring-pet-shelters-in-the-uae',
                    'body' => 'Pet shelters in the UAE play a pivotal role in rescuing and providing a sanctuary for abandoned animals. These shelters are not just brick-and-mortar structures; they represent hope, compassion, and a second chance for pets in need. From the bustling streets of Dubai to the serene landscapes of Abu Dhabi, pet shelters across the UAE are making a significant impact on the lives of countless animals.
                    <br><br>
                    In this in-depth exploration, we delve into the world of pet shelters, shedding light on the tireless efforts of organizations dedicated to the welfare of our furry friends. From heartwarming rescue stories to the day-to-day operations that go into caring for these animals, we uncover the challenges and triumphs that define the journey of a pet finding its forever home.
                    <br><br>
                    Join us on this emotional rollercoaster as we meet the passionate individuals behind these shelters, hear inspiring tales of rehabilitation, and discover how the community comes together to support these noble causes. From volunteering opportunities to adoption programs, this blog post aims to raise awareness about the crucial role pet shelters play in creating a compassionate and humane society in the UAE.
                    <br><br>
                    Whether you\'re a seasoned pet owner or someone considering adopting a pet, this exploration of pet shelters in the UAE promises to be an enlightening and heartwarming journey. Let\'s celebrate the unsung heroes who work tirelessly to give our furry companions a chance at a better life.',
                    'dashboard_user_id' => 1,
                    'publish_date' => '2024-02-15',
                ],
                [
                    'image' => 'https://images.pexels.com/photos/5998734/pexels-photo-5998734.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'title' => 'Must-Visit Pet Shops in the UAE',
                    'slug' => 'must-visit-pet-shops-in-the-uae',
                    'body' => 'The pet industry in the UAE is booming, and pet shops are at the forefront of this thriving ecosystem. Pet owners are not just looking for basic supplies; they seek unique products and personalized services that cater to the specific needs of their beloved companions. In this comprehensive guide, we embark on a journey to discover the must-visit pet shops across the United Arab Emirates.
                    <br><br>
                    From boutique stores in trendy neighborhoods to established chains with a wide range of offerings, we explore the diverse landscape of pet retail in the UAE. Each pet shop has its own story, ethos, and commitment to enhancing the lives of pets and their owners. We\'ll take you behind the scenes, showcasing the passionate individuals who curate the products, design the spaces, and ensure a memorable shopping experience for every customer.
                    <br><br>
                    This blog post goes beyond a mere list of pet shops; it\'s a celebration of the pet-friendly culture in the UAE. Join us as we highlight innovative products, share expert advice on pet care, and provide insights into the evolving trends shaping the pet retail landscape. Whether you\'re a first-time pet owner or a seasoned enthusiast, get ready to explore the vibrant world of pet shops in the UAE.',
                    'dashboard_user_id' => 1,
                    'publish_date' => '2024-02-20',
                ],
                [
                    'image' => 'https://images.pexels.com/photos/5731870/pexels-photo-5731870.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'title' => 'Top Pet Products for Your Furry Friends',
                    'slug' => 'top-pet-products-for-your-furry-friends',
                    'body' => 'In the ever-expanding market of pet products, choosing the right items for your furry friends can be a delightful yet challenging task. The UAE, known for its luxury and innovation, offers a plethora of options for pet owners looking to pamper their companions. In this detailed review, we present a curated list of the top pet products available in the UAE, catering to the diverse needs of pets and their owners.
                    <br><br>
                    From premium pet food brands with carefully selected ingredients to state-of-the-art grooming tools designed for maximum comfort, this blog post covers it all. We delve into the world of pet accessories, introducing you to the latest trends in pet fashion, collars, leashes, and toys. Our aim is to guide pet owners in making informed decisions that prioritize the health, happiness, and overall well-being of their beloved companions.
                    <br><br>
                    Join us as we interview industry experts, showcase real-life testimonials from pet owners, and explore the science behind some of the most innovative pet products in the market. Whether you have a playful pup, a regal cat, or any other furry friend, this blog post is your go-to resource for discovering and indulging in the best the UAE has to offer in the realm of pet products.',
                    'dashboard_user_id' => 1,
                    'publish_date' => '2024-02-25',
                ],
                [
                    'image' => 'https://images.pexels.com/photos/7474857/pexels-photo-7474857.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'title' => 'A Guide to Pet Clinics in the UAE',
                    'slug' => 'guide-to-pet-clinics-in-the-uae',
                    'body' => 'Pet health is a top priority for responsible pet owners, and having access to reliable pet clinics is essential for ensuring the well-being of our furry friends. The UAE boasts a network of state-of-the-art pet clinics, each committed to providing top-notch veterinary care. In this comprehensive guide, we take a closer look at pet clinics across the United Arab Emirates, providing pet owners with valuable insights into the services, expertise, and compassionate care these facilities offer.
                    <br><br>
                    From routine check-ups and vaccinations to emergency care and specialized treatments, this blog post covers the spectrum of veterinary services available in the UAE. We go beyond the clinical aspects, exploring the human-animal bond that forms the foundation of effective pet care. Interviews with experienced veterinarians, success stories of challenging cases, and tips for proactive pet health management are all part of this informative journey.
                    <br><br>
                    Whether you\'re a first-time pet owner or a seasoned enthusiast, this guide aims to empower you with the knowledge needed to make informed decisions about your pet\'s health. Join us as we navigate the world of pet clinics in the UAE, highlighting the role they play in promoting the longevity and happiness of our beloved animal companions.',
                    'dashboard_user_id' => 1,
                    'publish_date' => '2024-03-05',
                ],
                [
                    'image' => 'https://images.pexels.com/photos/2958113/pexels-photo-2958113.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'title' => 'Embracing the Joys of Having a Pet in the UAE',
                    'slug' => 'embracing-the-joys-of-having-a-pet-in-the-uae',
                    'body' => 'Owning a pet in the UAE is more than just a lifestyle choice; it\'s a journey filled with unconditional love, companionship, and joy. In this heartwarming blog post, we celebrate the unique bond between humans and their furry friends in the vibrant and pet-friendly community of the United Arab Emirates.
                    <br><br>
                    From the bustling cityscape of Dubai to the tranquil deserts of Abu Dhabi, pet owners in the UAE share common experiences, challenges, and triumphs. We explore the joys of adopting a pet, the laughter they bring into our homes, and the lessons they teach us about compassion and responsibility. Through heartfelt anecdotes, we highlight the positive impact pets have on mental well-being and the sense of community that arises from shared pet ownership experiences.
                    <br><br>
                    This blog post goes beyond the typical pet-related content; it\'s a tribute to the furry companions who enrich our lives. Whether you\'re considering bringing a pet into your home or you\'re a seasoned pet owner, join us as we reflect on the joys of having a pet in the UAE. From pet-friendly events to the growing community of pet enthusiasts, this celebration is a testament to the power of the human-animal bond in the dynamic and diverse landscape of the UAE.',
                    'dashboard_user_id' => 1,
                    'publish_date' => '2024-03-10',
                ],
                [
                    'image' => 'https://images.pexels.com/photos/5745275/pexels-photo-5745275.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'title' => 'Prioritizing Pet Wellness: A Holistic Approach',
                    'slug' => 'prioritizing-pet-wellness-holistic-approach',
                    'body' => 'Pet wellness is not just about the absence of illness; it\'s a holistic approach that encompasses physical health, mental well-being, and a balanced lifestyle. In this in-depth exploration, we dive into the various aspects of pet wellness, providing pet owners in the UAE with valuable insights on nutrition, mental stimulation, and preventive care.
                    <br><br>
                    From understanding the nutritional needs of different breeds to exploring enriching activities that enhance cognitive function, this blog post aims to guide pet owners in creating a well-rounded and fulfilling life for their furry companions. Interviews with holistic veterinarians, real-life stories of pets overcoming health challenges, and practical tips for incorporating wellness into daily routines make this a comprehensive resource for those committed to the optimal health and happiness of their pets.
                    <br><br>
                    Join us as we navigate the world of pet wellness in the UAE, exploring the unique challenges and opportunities that come with caring for our four-legged friends in this dynamic and diverse environment.',
                    'dashboard_user_id' => 1,
                    'publish_date' => '2024-03-15',
                ],
                [
                    'image' => 'https://images.pexels.com/photos/17425763/pexels-photo-17425763/free-photo-of-cat-lying-on-pillow-of-sidewalk-cafe.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'title' => 'Discovering Pet-Friendly Spots in the UAE',
                    'slug' => 'discovering-pet-friendly-spots-in-the-uae',
                    'body' => 'Being a pet owner in the UAE comes with the joy of exploring a plethora of pet-friendly spots, from parks and cafes to beaches and events. In this lively blog post, we take you on a tour of the most welcoming and enjoyable places for you and your furry companion. Discover hidden gems, meet like-minded pet enthusiasts, and make the most of the vibrant pet-friendly culture that the UAE has to offer.
                    <br><br>
                    Whether you\'re planning a weekend outing, searching for a cozy cafe where your pet is as welcome as you are, or looking for scenic parks for leisurely strolls, this blog post has you covered. We provide firsthand accounts of pet owners sharing their favorite spots, tips for navigating pet-friendly establishments, and a calendar of upcoming events that celebrate the bond between pets and their owners.
                    <br><br>
                    Join us as we celebrate the inclusivity and warmth of the pet community in the UAE. This blog post is your go-to guide for turning ordinary outings into extraordinary adventures with your beloved furry friend by your side.',
                    'dashboard_user_id' => 1,
                    'publish_date' => '2024-03-20',
                ],
                [
                    'image' => 'https://images.pexels.com/photos/2253805/pexels-photo-2253805.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'title' => 'Exotic Pets in the UAE: A Fascinating World',
                    'slug' => 'exotic-pets-in-the-uae-fascinating-world',
                    'body' => 'While cats and dogs are beloved staples of the pet community, the UAE is also home to a fascinating world of exotic pets. In this captivating blog post, we explore the unique and diverse range of exotic pets that have found homes in the United Arab Emirates. From rare reptiles to exotic birds and small mammals, we delve into the responsible ownership, care, and regulations surrounding these extraordinary companions.
                    <br><br>
                    Interviews with exotic pet enthusiasts, insights from exotic veterinarians, and captivating stories of unique pets and their owners are woven into this exploration. We aim to shed light on the responsible and ethical aspects of caring for exotic pets, highlighting the need for proper knowledge, resources, and a commitment to their specialized needs.
                    <br><br>
                    Join us as we embark on a journey through the exotic pet community in the UAE, celebrating the diversity and passion that define this extraordinary corner of the pet world.',
                    'dashboard_user_id' => 1,
                    'publish_date' => '2024-03-25',
                ],
                [
                    'image' => 'https://images.pexels.com/photos/11725643/pexels-photo-11725643.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'title' => 'Caring for Senior Pets: A Guide for UAE Pet Owners',
                    'slug' => 'caring-for-senior-pets-guide-uae',
                    'body' => 'As our beloved pets age, their needs and requirements change, necessitating a shift in our approach to their care. In this compassionate and informative blog post, we address the unique challenges and joys of caring for senior pets in the UAE. From dietary considerations and health monitoring to creating a comfortable environment, this guide aims to empower pet owners with the knowledge and resources needed to provide the best possible life for their aging companions.
                    <br><br>
                    Interviews with veterinarians specializing in geriatric pet care, personal anecdotes from senior pet owners, and expert advice on navigating the various aspects of senior pet wellness are all part of this comprehensive resource. We delve into the importance of regular veterinary check-ups, the role of nutrition in supporting senior pets, and the emotional connection that deepens as pets gracefully age.
                    <br><br>
                    Join us as we navigate the journey of senior pet care in the UAE, offering valuable insights and support for those who cherish the wisdom and companionship that come with having a senior pet by their side.',
                    'dashboard_user_id' => 1,
                    'publish_date' => '2024-04-01',
                ],
                [
                    'image' => 'https://images.pexels.com/photos/7474567/pexels-photo-7474567.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'title' => 'The Joy of Pet Adoption: Stories from the UAE',
                    'slug' => 'joy-of-pet-adoption-stories-uae',
                    'body' => 'Pet adoption is a transformative experience, not just for the pets finding their forever homes but also for the individuals and families opening their hearts to a new furry family member. In this heart-touching blog post, we share inspiring stories of pet adoption from the UAE, celebrating the joy, challenges, and unconditional love that come with welcoming a rescued pet into your home.
                    <br><br>
                    Through interviews with adopters, rescue organizations, and heartwarming tales of transformation, we aim to highlight the positive impact of pet adoption in the UAE. From the initial decision to adopt to the journey of integration and the profound bond that develops over time, this blog post captures the essence of the adoption experience.
                    <br><br>
                    Whether you\'re contemplating adopting a pet or you\'re a seasoned adopter yourself, join us as we explore the transformative power of pet adoption in the unique context of the United Arab Emirates. This blog post is a testament to the incredible journeys of resilience, hope, and love that unfold when individuals choose to make a difference in the lives of animals through adoption.',
                    'dashboard_user_id' => 1,
                    'publish_date' => '2024-04-05',
                ],
            ];

        foreach ($blogsData as $data) {
            Blog::query()->create($data);
        }
    }

    private function seed_product_categories()
    {
        $arduino = ProductCategory::query()->create([
            ProductCategory::ATTR_TITLE => 'Arduino',
            ProductCategory::ATTR_SLUG => Str::slug('Arduino'),
            ProductCategory::ATTR_PARENT_CATEGORY_ID => null,
        ]);

        $raspberry_pi = ProductCategory::query()->create([
            ProductCategory::ATTR_TITLE => 'Raspberry Pi',
            ProductCategory::ATTR_SLUG => Str::slug('Raspberry Pi'),
            ProductCategory::ATTR_PARENT_CATEGORY_ID => null,
        ]);
        
        $teensy = ProductCategory::query()->create([
            ProductCategory::ATTR_TITLE => 'Teensy',
            ProductCategory::ATTR_SLUG => Str::slug('Teensy'),
            ProductCategory::ATTR_PARENT_CATEGORY_ID => null,
        ]);

        $motors = ProductCategory::query()->create([
            ProductCategory::ATTR_TITLE => 'Motors & Drives',
            ProductCategory::ATTR_SLUG => Str::slug('Motors & Drives'),
            ProductCategory::ATTR_PARENT_CATEGORY_ID => null,
        ]);

        $sensors = ProductCategory::query()->create([
            ProductCategory::ATTR_TITLE => 'Sensors',
            ProductCategory::ATTR_SLUG => Str::slug('Sensors'),
            ProductCategory::ATTR_PARENT_CATEGORY_ID => null,
        ]);

        $components = ProductCategory::query()->create([
            ProductCategory::ATTR_TITLE => 'Passive & Active Components',
            ProductCategory::ATTR_SLUG => Str::slug('Passive & Active Components'),
            ProductCategory::ATTR_PARENT_CATEGORY_ID => null,
        ]);

        $Semiconductors = ProductCategory::query()->create([
            ProductCategory::ATTR_TITLE => 'Semiconductors',
            ProductCategory::ATTR_SLUG => Str::slug('Semiconductors'),
            ProductCategory::ATTR_PARENT_CATEGORY_ID => null,
        ]);

        $arduino->children()->createMany([
            [
                'title' => 'Arduino Microcontrollers',
                'slug' => Str::slug('Arduino Microcontrollers'),
                'parent_category_id' => $arduino->id,
            ],
            [
                'title' => 'Arduino Kits',
                'slug' => Str::slug('Arduino Kits'),
                'parent_category_id' => $arduino->id,
            ],
            [
                'title' => 'Arduino Accessories',
                'slug' => Str::slug('Arduino Accessories'),
                'parent_category_id' => $arduino->id,
            ],
            [
                'title' => 'Arduino Shields',
                'slug' => Str::slug('Arduino Shields'),
                'parent_category_id' => $arduino->id,
            ],
        ]);

        $raspberry_pi->children()->createMany([
            [
                'title' => 'Raspberry Pi Microcontrollers',
                'slug' => Str::slug('Raspberry Pi Microcontrollers'),
                'parent_category_id' => $raspberry_pi->id,
            ],
            [
                'title' => 'Raspberry Pi Kits',
                'slug' => Str::slug('Raspberry Pi Kits'),
                'parent_category_id' => $raspberry_pi->id,
            ],
            [
                'title' => 'Raspberry Pi Accessories',
                'slug' => Str::slug('Raspberry Pi Accessories'),
                'parent_category_id' => $raspberry_pi->id,
            ],
            [
                'title' => 'Raspberry Pi Shields',
                'slug' => Str::slug('Raspberry Pi Shields'),
                'parent_category_id' => $raspberry_pi->id,
            ],
        ]);

        $motors->children()->createMany([
            [
                'title' => 'Servo Motors',
                'slug' => Str::slug('Servo Motors'),
                'parent_category_id' => $motors->id,
            ],
            [
                'title' => 'DC Motors',
                'slug' => Str::slug('DC Motors'),
                'parent_category_id' => $motors->id,
            ],
            [
                'title' => 'Gear Motors',
                'slug' => Str::slug('Gear Motors'),
                'parent_category_id' => $motors->id,
            ],
            [
                'title' => 'Stepper Motors',
                'slug' => Str::slug('Stepper Motors'),
                'parent_category_id' => $motors->id,
            ],
            [
                'title' => 'Driver Boards',
                'slug' => Str::slug('Driver Boards'),
                'parent_category_id' => $motors->id,
            ],
            [
                'title' => 'Brushless Motors',
                'slug' => Str::slug('Brushless Motors'),
                'parent_category_id' => $motors->id,
            ],
            [
                'title' => 'Motor Accessories',
                'slug' => Str::slug('Motor Accessories'),
                'parent_category_id' => $motors->id,
            ],
            [
                'title' => 'Wheels',
                'slug' => Str::slug('Wheels'),
                'parent_category_id' => $motors->id,
            ],
        ]);

        $sensors->children()->createMany([
            [
                'title' => 'Air Sensors',
                'slug' => Str::slug('Air Sensors'),
                'parent_category_id' => $sensors->id,
            ],
            [
                'title' => 'Current & Voltage Sensors',
                'slug' => Str::slug('Current & Voltage Sensors'),
                'parent_category_id' => $sensors->id,
            ],
            [
                'title' => 'Flex Sensors',
                'slug' => Str::slug('Flex Sensors'),
                'parent_category_id' => $sensors->id,
            ],
            [
                'title' => 'IR, Light & Imaging Sensors',
                'slug' => Str::slug('IR, Light & Imaging Sensors'),
                'parent_category_id' => $sensors->id,
            ],
            [
                'title' => 'Liquid Sensors',
                'slug' => Str::slug('Liquid Sensors'),
                'parent_category_id' => $sensors->id,
            ],
            [
                'title' => 'Motion Sensors',
                'slug' => Str::slug('Motion Sensors'),
                'parent_category_id' => $sensors->id,
            ],
            [
                'title' => 'Potentiometer',
                'slug' => Str::slug('Potentiometer'),
                'parent_category_id' => $sensors->id,
            ],
            [
                'title' => 'Pressure Sensors',
                'slug' => Str::slug('Pressure Sensors'),
                'parent_category_id' => $sensors->id,
            ],
            [
                'title' => 'Range & Distance Sensors',
                'slug' => Str::slug('Range & Distance Sensors'),
                'parent_category_id' => $sensors->id,
            ],
            [
                'title' => 'Sensor Kits',
                'slug' => Str::slug('Sensor Kits'),
                'parent_category_id' => $sensors->id,
            ],
            [
                'title' => 'Sound Sensors',
                'slug' => Str::slug('Sound Sensors'),
                'parent_category_id' => $sensors->id,
            ],
            [
                'title' => 'Temperature & Humidity Sensors',
                'slug' => Str::slug('Temperature & Humidity Sensors'),
                'parent_category_id' => $sensors->id,
            ],
            [
                'title' => 'Weight Sensors',
                'slug' => Str::slug('Weight Sensors'),
                'parent_category_id' => $sensors->id,
            ],
        ]);

        $components->children()->createMany([
            [
                'title' => 'Capacitors',
                'slug' => Str::slug('Capacitors'),
                'parent_category_id' => $components->id,
            ],
            [
                'title' => 'Resistors',
                'slug' => Str::slug('Resistors'),
                'parent_category_id' => $components->id,
            ],
            [
                'title' => 'Inductors',
                'slug' => Str::slug('Inductors'),
                'parent_category_id' => $components->id,
            ],
        ]);

        $Semiconductors->children()->createMany([
            [
                'title' => 'Diodes',
                'slug' => Str::slug('Diodes'),
                'parent_category_id' => $Semiconductors->id,
            ],
            [
                'title' => 'BJT & IGBT',
                'slug' => Str::slug('BJT & IGBT'),
                'parent_category_id' => $Semiconductors->id,
            ],
            [
                'title' => 'Transistors',
                'slug' => Str::slug('Transistors'),
                'parent_category_id' => $Semiconductors->id,
            ],
        ]);
    }

    private function seed_products()
    {
        $productData = [
            [
                'name' => 'Raspberry Pi 4 Model B',
                'brand_name' => 'Raspberry Pi',
                'slug' => 'raspberry-pi-4-model-b',
                'description' => 'Powerful single-board computer for various applications.',
                'image' => 'https://www.seeedstudio.com/blog/wp-content/uploads/2019/06/WechatIMG1371.png',
                'price' => 35.99,
                'index' => 0,
                'stock_quantity' => 50,
                'moq' => 100,
                Product::ATTR_PRODUCT_CATEGORY_ID => 12,
            ],
            [
                'name' => 'Arduino Uno R3',
                'brand_name' => 'Arduino',
                'slug' => 'arduino-uno-r3',
                'description' => 'Versatile open-source electronics platform for creators.',
                'image' => 'https://rukminim1.flixcart.com/image/1664/1664/j76i3rk0/learning-toy/j/z/8/arduino-uno-r3-board-with-dip-atmega328p-adraxx-original-imaexh74faqkvygt.jpeg?q=90',
                'price' => 24.99,
                'index' => 1,
                'stock_quantity' => 50,
                'moq' => 100,
                Product::ATTR_PRODUCT_CATEGORY_ID => 8,
            ],
            [
                'name' => 'ESP8266 WiFi Module',
                'brand_name' => 'Generic',
                'slug' => 'esp8266-wifi-module',
                'description' => 'Wireless communication module for IoT projects.',
                'image' => 'https://tse1.mm.bing.net/th?id=OIP.5LofEV_I-Y9PG-53g9Iu5AHaHa&pid=Api&P=0&h=220',
                'price' => 3.49,
                'index' => 2,
                'stock_quantity' => 50,
                'moq' => 100,
                Product::ATTR_PRODUCT_CATEGORY_ID => 8,
            ],
            [
                'name' => 'MPU6050 Gyroscope and Accelerometer Module',
                'brand_name' => 'Generic',
                'slug' => 'mpu6050-gyroscope-and-accelerometer-module',
                'description' => 'Module for measuring motion and orientation.',
                'image' => 'https://tse3.mm.bing.net/th?id=OIP.9F2kvsmNfU-ekR6VZwVu4QHaFx&pid=Api&P=0&h=220',
                'price' => 15.99,
                'index' => 3,
                'stock_quantity' => 50,
                'moq' => 100,
                Product::ATTR_PRODUCT_CATEGORY_ID => 20,
            ],
            [
                'name' => 'DHT22 Temperature and Humidity Sensor',
                'brand_name' => 'Generic',
                'slug' => 'dht22-temperature-and-humidity-sensor',
                'description' => 'Sensor for measuring temperature and humidity.',
                'image' => 'https://tse3.mm.bing.net/th?id=OIP.QZI5OE82YcwbFmafi3MSmAHaHa&pid=Api&P=0&h=220',
                'price' => 9.99,
                'index' => 4,
                'stock_quantity' => 50,
                'moq' => 100,
                Product::ATTR_PRODUCT_CATEGORY_ID => 8,
            ],
            [
                'name' => 'BME280 Environmental Sensor',
                'brand_name' => 'Generic',
                'slug' => 'bme280-environmental-sensor',
                'description' => 'Sensor for measuring environmental conditions.',
                'image' => 'https://images-na.ssl-images-amazon.com/images/I/41j5cHWfpDL.jpg',
                'price' => 8.99,
                'index' => 5,
                'stock_quantity' => 50,
                'moq' => 100,
                Product::ATTR_PRODUCT_CATEGORY_ID => 8,
            ],
            [
                'name' => 'Breadboard Jumper Wires Kit',
                'brand_name' => 'Generic',
                'slug' => 'breadboard-jumper-wires-kit',
                'description' => 'Kit of jumper wires for prototyping on a breadboard.',
                'image' => 'https://res.cloudinary.com/rsc/image/upload/b_rgb:FFFFFF,c_pad,dpr_1.0,f_auto,q_auto,w_700/c_pad,w_700/F7916454-01',
                'price' => 6.99,
                'index' => 6,
                'stock_quantity' => 50,
                'moq' => 100,
                Product::ATTR_PRODUCT_CATEGORY_ID => 8,
            ],
            [
                'name' => 'STMicroelectronics Nucleo-F401RE Development Board',
                'brand_name' => 'STMicroelectronics',
                'slug' => 'stmicroelectronics-nucleo-f401re-development-board',
                'description' => 'Development board for microcontroller projects.',
                'image' => 'https://media.rs-online.com/f_auto/F8029425-01.jpg',
                'price' => 19.99,
                'index' => 7,
                'stock_quantity' => 50,
                'moq' => 100,
                Product::ATTR_PRODUCT_CATEGORY_ID => 8,
            ],
            [
                'name' => 'LM317 Adjustable Voltage Regulator',
                'brand_name' => 'Generic',
                'slug' => 'lm317-adjustable-voltage-regulator',
                'description' => 'Voltage regulator for electronic circuits.',
                'image' => 'https://i5.walmartimages.com/asr/becb1f3d-da68-4fe4-ae95-1a031d7e068a_1.590bdaf485016abeff4daf43c9ff3a85.jpeg',
                'price' => 1.99,
                'index' => 8,
                'stock_quantity' => 50,
                'moq' => 100,
                Product::ATTR_PRODUCT_CATEGORY_ID => 8,
            ],
            [
                'name' => 'Soldering Iron Kit',
                'brand_name' => 'Generic',
                'slug' => 'soldering-iron-kit',
                'description' => 'Kit for soldering electronic components.',
                'image' => 'https://tse3.mm.bing.net/th?id=OIP.w9Q9-ejAmxUgg0v6tezclgHaHa&pid=Api&P=0&h=220',
                'price' => 29.99,
                'index' => 9,
                'stock_quantity' => 50,
                'moq' => 100,
                Product::ATTR_PRODUCT_CATEGORY_ID => 8,
            ],
        ];

        foreach ($productData as $data) {
            $product = Product::query()->create($data);
            //$product->petTypes()->attach(fake()->numberBetween(1, 9));
        }

        // foreach ($images as $image) {
        //     ProductImage::create($image);
        // }
    }
}
