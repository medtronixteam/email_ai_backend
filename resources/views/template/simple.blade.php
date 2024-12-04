@php
//     $result = [
//     '[content1]' => 'New Content',
//     '[content2]' => '
// Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, sequi sit. Fugit dolorum facilis ratione nesciunt, amet molestiae repellendus quis consequatur harum nihil accusamus minima exercitationem ipsam obcaecati et quasi!',
// ];
$other=str_replace(array_keys($contents),array_values($contents), $tamplate->description);
@endphp
{!!$other!!}