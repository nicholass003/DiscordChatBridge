</br>

<div align="center">

<img src="assets/icon.png">

<h3 align="center">DiscordChatBridge</h4>

<p align="center">
💬 A PocketMine-MP plugins which is a chat bridge between minecraft be and discord.

[![State](https://poggit.pmmp.io/shield.state/DiscordChatBridge)](https://poggit.pmmp.io/p/DiscordChatBridge) [![API](https://poggit.pmmp.io/shield.api/DiscordChatBridge)](https://poggit.pmmp.io/p/DiscordChatBridge) [![Total Downloads](https://poggit.pmmp.io/shield.dl.total/DiscordChatBridge)](https://poggit.pmmp.io/p/DiscordChatBridge) [![GitHub License](https://img.shields.io/github/license/nicholass003/DiscordChatBridge)](LICENSE) [![Discord](https://img.shields.io/discord/1230982180742631457?logo=discord&logoColor=white&color=5865F2)](https://discord.gg/EEJK2vxtCp) 

</p>

</div>

## 📜 Description

This plugin is an intermediary between Minecraft BE and Discord, the system of this plugin uses the GET method which requires Authorization, Channel ID, Webhook URL, and Webhook Name.

### How to get the required data?

To get this data, go to your Discord server then select the channel that will be used as a bridge, then press F12 to inspect, after that go to the `Network` tab. 
- **Channel ID:**   On the `General` tab, look for `Request URL`, on the link `https://discord.com/api/v9/channels/{numbers}/messages?limit=50`, {numbers} is your Channel ID.
- **Authorization:**    Look for `{;} messages?limit=50` in the name row then scroll down the Headers row until you find the `Request Headers` tab, then copy the Authorization which contains random letters and numbers.
- **Webhook URL & Name:**   To get the Webhook URL and Webhook Name, you can get it on the Edit Channel -> Integrations.

## 🌟 Features

- Players from Discord and Minecraft BE can communicate.
- Customizable message prefix.

## 🛠️ Installation

1. Download the plugin from the [poggit](https://poggit.pmmp.io/ci/nicholass003/DiscordChatBridge).
2. Extract the downloaded file into the `plugins` folder in your PocketMine-MP directory.
3. Restart your PocketMine-MP server.

## 💡 Issues & Suggestions

Feel free to creating an issues for bug reports and feature requests!

## 💖 Support Development

If you find my PocketMine-MP plugins useful and wish to support their ongoing development and maintenance, your contributions are greatly appreciated. Your generosity enables me to dedicate more time and resources to improving and expanding the functionality of these plugins for the benefit of the community.

### How to Contribute

You can support this project in several ways:

- 💰 **Financial Contributions**: Donations are welcome via [PayPal](https://paypal.me/FireRashkar). Your financial support helps cover hosting costs, development tools, and other expenses associated with maintaining this project.
  
- 📝 **Feedback and Suggestions**: Your feedback is invaluable in shaping the future direction of these plugins. Whether you encounter a bug, have an idea for a new feature, or simply want to share your thoughts, please don't hesitate to open an issue or reach out to me directly.
  
- 💻 **Code Contributions**: If you're a developer and would like to contribute to the codebase, pull requests are always welcome.
  
### Acknowledgements

I would like to express my heartfelt gratitude to all the individuals and organizations who have supported this project through their contributions, be it through code, financial donations, or valuable feedback. Your support keeps this project alive and thriving.

Thank you for your continued support and encouragement!

## 🎖️ Credits

<a target="_blank" href="https://icons8.com/icon/7ZiLZvoT0ICd/discord-bubble">Discord Bubble</a> icon by <a target="_blank" href="https://icons8.com">Icons8</a>