# 🎨 Placehold.cloud - The Ultimate Placeholder Generator

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-13.x-red" alt="Laravel Version">
  <img src="https://img.shields.io/badge/PHP-8.3+-blue" alt="PHP Version">
  <img src="https://img.shields.io/badge/License-MIT-green" alt="License">
</p>

<p align="center">
  <strong>The #1 destination for all your placeholder needs!</strong><br>
  Generate custom images, text, icons, quotes, jokes, weather data, recipes, and more with ease.
</p>

## 🌟 Why Placehold.cloud?

**Placehold.cloud** is your one-stop-shop for everything placeholder-related. Built with Laravel 13 and powered by PHP 8.3+, we provide the fastest, most flexible placeholder generation service on the web.

### ✨ Features

#### 📸 **Placeholder Images**
- **Customizable dimensions** - Any size from 1x1 to 2000x2000
- **Multiple formats** - PNG, JPG, GIF, WebP, and SVG
- **Full customization** - Background colors, text colors, borders, fonts, watermarks
- **Advanced effects** - Blur, grayscale, invert filters
- **Special modes** - Cat, dog, and robot placeholders
- **Intelligent caching** - Lightning-fast responses with week-long cache

#### 📝 **Lorem Ipsum Text**
- **Flexible generation** - Paragraphs, word counts, seeds
- **Multiple formats** - JSON, HTML, plain text
- **Customization options** - Capitalization, punctuation, unique words
- **Repeatable results** - Seed-based generation for consistency

#### 🎯 **Holdicon Magic**
- **Text-based icons** - Quick placeholder icons with custom text
- **Animal favorites** - Cat, dog, and robot variants
- **Perfect sizing** - Optimized for any display

#### 📚 **Additional Content Generators**
- **Quotes** - Inspirational and random quotes
- **Jokes** - Lighten up your development with humor
- **Weather** - Real-time weather data for any location
- **Recipes** - Cooking inspiration and meal ideas
- **Icon Library** - 117+ beautiful SVG icons

## 🚀 Quick Start

### For Developers

**Generate a 500x300 placeholder image:**
```
https://placehold.cloud/p/500x300
```

**Custom colors and text:**
```
https://placehold.cloud/p/500x300/F44336/FFFFFF?text=Hello+World
```

**Lorem Ipsum API:**
```
https://placehold.cloud/l?paragraphs=3&minWords=10&maxWords=20
```

**Cat placeholder:**
```
https://placehold.cloud/p/500x300?cat=true
```

### For Designers

1. Visit the intuitive web interface
2. Choose your generator type
3. Customize with real-time previews
4. Copy the URL or download directly

## 🛠️ Technical Stack

- **Framework**: Laravel 13.x
- **PHP**: 8.3+
- **Image Processing**: Intervention Image 3.8, GD Library
- **SVG Generation**: PHP-SVG
- **Frontend**: Tailwind CSS, Vite

## 📋 API Endpoints

### Placeholder Images
```
GET /p/{size}/{background_color}/{text_color}
GET /p/{size}?text={text}&format={format}&quality={quality}
GET /p/{size}?cat=true
GET /p/{size}?dog=true
GET /p/{size}?robot=true
```

**Parameters:**
- `size` - Dimensions (e.g., `500x300` or `300`)
- `background_color` - Hex color (e.g., `C8C8C8`)
- `text_color` - Hex color (e.g., `323232`)
- `text` - Custom text
- `format` - `png`, `jpg`, `gif`, `webp`, `svg`
- `quality` - 0-100
- `font` - `arial`, `couri`, `times`, `tron`
- `border_color` - Hex color
- `watermark` - Watermark text
- `blur` - 0-100
- `grayscale` - `true`/`false`
- `invert` - `true`/`false`

### Lorem Ipsum
```
GET /l?paragraphs={count}&minWords={min}&maxWords={max}
```

**Parameters:**
- `paragraphs` - Number of paragraphs (1-100)
- `minWords` - Minimum words per paragraph (1-100)
- `maxWords` - Maximum words per paragraph (1-100)
- `format` - `json`, `html`, `text`
- `startWithLoremIpsum` - `true`/`false`
- `capitalize` - `true`/`false`
- `addPunctuation` - `true`/`false`
- `seed` - Random seed for repeatability
- `uniqueWords` - `true`/`false`

### Additional Services
```
GET /q       - Random quote
GET /j       - Random joke
GET /w       - Weather data
GET /r       - Recipe suggestion
GET /h       - Holdicon placeholder
GET /download-all-icons - Download icon pack
```

## 🎨 Use Cases

- **Web Development**: Quick mockups and prototypes
- **Design Systems**: Component placeholders
- **Testing**: API response simulation
- **Documentation**: Example assets
- **Education**: Teaching material
- **Presentations**: Visual aids

## 💡 Why Developers Choose Placehold.cloud

✅ **Reliability** - 99.9% uptime with intelligent caching  
✅ **Speed** - Sub-100ms response times  
✅ **Flexibility** - Endless customization options  
✅ **Free** - No registration, no limits  
✅ **Open Standards** - RESTful API, standard formats  
✅ **Modern Stack** - Built on Laravel 13, PHP 8.3+  
✅ **CDN Ready** - Optimized headers for caching  

## 🤝 Contributing

We welcome contributions! Whether it's:
- Bug fixes
- New features
- Documentation improvements
- Performance optimizations
- Design enhancements

Please check our issues page and submit pull requests.

## 📄 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 🌐 Links

- **Live Site**: [placehold.cloud](https://placehold.cloud)
- **API Documentation**: [placehold.cloud/api](https://placehold.cloud/api)
- **About**: [placehold.cloud/about-us](https://placehold.cloud/about-us)
- **Contact**: [placehold.cloud/contact](https://placehold.cloud/contact)

## 🙏 Acknowledgments

Built with ❤️ using Laravel, the world's most popular PHP framework.

---

**Made for developers, by developers.**

*Placehold.cloud - Where placeholders come to life* ✨
