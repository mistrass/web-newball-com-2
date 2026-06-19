<?php

class LinkCard
{
    private string $url;
    private string $title;
    private string $description;
    private string $image;
    private array $branding;

    public function __construct(string $url, string $title, string $description = '', string $image = '')
    {
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->branding = [
            'accent' => '#1a73e8',
            'shadow' => 'rgba(0,0,0,0.08)',
            'radius' => '12px',
        ];
    }

    public function setBranding(array $branding): void
    {
        $this->branding = array_merge($this->branding, $branding);
    }

    public function render(): string
    {
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDesc = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedImage = htmlspecialchars($this->image, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $accent = htmlspecialchars($this->branding['accent'], ENT_QUOTES, 'UTF-8');
        $shadow = htmlspecialchars($this->branding['shadow'], ENT_QUOTES, 'UTF-8');
        $radius = htmlspecialchars($this->branding['radius'], ENT_QUOTES, 'UTF-8');

        $imageHtml = '';
        if ($escapedImage !== '') {
            $imageHtml = '<div class="link-card-image" style="flex-shrink:0;width:120px;height:120px;border-radius:8px;overflow:hidden;margin-left:16px;background:#f0f0f0;">'
                . '<img src="' . $escapedImage . '" alt="' . $escapedTitle . '" style="width:100%;height:100%;object-fit:cover;display:block;" />'
                . '</div>';
        }

        $html = '<div class="link-card" style="display:flex;align-items:center;padding:16px 20px;border:1px solid #e0e0e0;border-radius:' . $radius . ';background:#ffffff;box-shadow:0 2px 8px ' . $shadow . ';max-width:600px;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;transition:box-shadow 0.2s ease;">'
            . '<div style="flex:1;min-width:0;">'
            . '<a href="' . $escapedUrl . '" target="_blank" rel="noopener noreferrer" style="text-decoration:none;color:' . $accent . ';font-size:16px;font-weight:600;line-height:1.4;display:block;margin-bottom:6px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">'
            . $escapedTitle
            . '</a>'
            . '<p style="margin:0;font-size:14px;line-height:1.5;color:#555;overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;">'
            . $escapedDesc
            . '</p>'
            . '<span style="display:inline-block;margin-top:8px;font-size:12px;color:#888;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:100%;">'
            . $escapedUrl
            . '</span>'
            . '</div>'
            . $imageHtml
            . '</div>';

        return $html;
    }

    public static function createDefault(): self
    {
        return new self(
            'https://web-newball.com',
            '新球体育 - 全新赛事体验',
            '提供最新体育赛事资讯、实时比分与深度分析，覆盖足球、篮球、网球等多个热门项目。',
            ''
        );
    }
}

function renderLinkCard(string $url, string $title, string $description = '', string $image = ''): string
{
    $card = new LinkCard($url, $title, $description, $image);
    return $card->render();
}

// 示例用法
$cardHtml = renderLinkCard(
    'https://web-newball.com',
    '新球体育 ｜ 首页',
    '关注新球体育，获取全球赛事动态与专业评论。'
);

echo $cardHtml;