
## About OCRusion
OCRusionはオンラインでOCR処理をするWEBサービスです。
GoogleのCloud Vision APIを利用して、OCR処理を行っています。
期待通り動かなかった、もっと使いやすくしてほしいことがあればIssueなどでご連絡ください。

[OCRusion | 日本語OCRサービス](https://ocrusion.my-portfolio.site/)

## License

The OCRusion is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 技術的説明
根本的にはGoogleCloudVisionAPIを利用して、`RequestCloudVision`クラスを使用して、ファイルをOCR化しています。

現在の所(2018/10/26)Googleの仕様により、1リクエスト中、画像ファイルは16枚アップできますが、ファイルサイズは8MBまでです。

ちなみにBase64エンコード化されていますので、画像ファイルそのままよりもややバイトサイズは大きくなります。

APIにcURLを利用してアクセスし、`json_decode`しています。




