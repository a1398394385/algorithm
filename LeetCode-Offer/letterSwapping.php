<?php

/**
 * abcbaa
 * a => [0, 4, 5]
 * b => [1, 3]
 * c => [2]
 */

/**
 * 字母交换
 *
 * @param string $str
 * @param int $n
 * @return int
 */
function letterSwapping($str, $n)
{
    $result = 0;
    $letterPosition = [];
    $lenght = strlen($str);
    for ($i = 0; $i < $lenght; $i++) {
        $letterPosition[$str[$i]][] = $i;
    }
    foreach ($letterPosition as $key => $positions) {
        $count = count($positions);
        $moves = array_fill(0, $count, array_fill(0, $count, 0));
        for ($left = $count - 1; $left >= 0; $left--) {
            for ($right = $left + 1; $right < $count; $right++) {
                $move = $positions[$right] - $positions[$left] - ($right - $left);
                if ($right > $left + 1)
                    $move += $moves[$left + 1][$right - 1];
                $moves[$left][$right] = $move;
                if ($moves[$left][$right] <= $n)
                    $result = max($result, $right - $left + 1);
            }
        }
    }
    return $result;
}

// TODO:Test
$input = 'abcbaa 2';
$input = 'hkdbqojqvxlfulshrhpysezhlyzolb 20';
$input = 'ooxnwetkuvpqjuabmovhkpypxbgpxzemuupqvavonyfscmkrvsvixcejdrutwwfndzkdxbrwgptievanpqfzlprwyqupidspcgrw 200';
$input = 'tajtwjurqbrplbyucjnaglozuxrdwmhqtnispsdyslbfpjlwocursljdmvqikssrtmfpnkfnfrygtvcelahhzjkhwhcgrcclnuixzaogmjwwkjmcucphkwynlaodrvqrwoedwmmtanyzfxyhtkvthbekfydzlhirchjyzzkonswppfpteuikbcqpezbpkhrletobtwjyvenaelsrmqegdgajqwqblkxknpbosjgroyjytyaibnmadfyjegplhppitsoqhelwjwgfaillswgpijwqmjgbvbuhgbdcvvkwyhowxeghylqsvolglgtkjcniqniiomeusnbrpotaliaotojqgyccfprkeyazwiudvioiftvjdfpwwbzyjusiqtjdcytzaqcccrsikepharobtznzmjnhtqxipwblnqmzmekonoxfdvrrbkdmhuucxqezktswbugsijcslbwjwnzaqkmbeuvywiixyttwmtpgtqovvectzmnmlgkihlsdhkfkscaooumebtiowknkgrejzntjnrwlbvjuheyhjyptyzaprxhjzgzwltomhwsvpqqzhveflcsoubwiglwhwnucbkxpueodizurmxfagmcwozujnjaocvlwjtgjxhcirludabbbthyeijszeoocnzgganuzpwdllakcuilgrkklnuuzidthdeqsjpbvppczjelpcfmkmvxaafizgcuybufgmhoaobboyjpyvxmtkaxkpysfpkzkbjjofkdlaozpadqfvizzgelqjlyobtyfzedwlzohyaqifebeqgckwslgqynkdoxckmyrdovwvldixikiafpvvxkuddlnpwgkeavbnisnqrwatzuelwodzaakiqtypfikxowshhcbqyirdbprunhmobxuyzdnevpnkgtcqablvyhijfsgqnwuvwkngvxfpapezgtrzekwiyizdyeqzufxjnychuydkkowoarnoispgudljgbvajjfnrbbwxypwlyoxfipoxynnpqjihautixrsxykidrbwauxepcolvjysfrjhbtfxfyiqvnwdzjhomfszpbbynphkveqgzxcdizroaassypqlxemolkmcjddtnvwzvayknofahowbuhwkercutxcdbxdeuviuofvqobvklwcdwcrypbumabghcashjxzsdumtlctixviryslkvisfvgazwkoddqvsncewujxlxdvbbvvzmdfsauaqolzgdgchfltveznaymxfzkymtgmjhianadgghmltqlmzhjocejrzgxxklrjhcycgdjvfhraxuusplhhbsurekuityhgigoszyvfuiewzpbkymayydyyfupwkcmcptbonayvwyicuskiaqwckaleibhhbvkbhoxpqxxkzeciaazaqhjxmvqjjyifeigkbjtdlbgjwmcdiljhwnauuchyiqevzmokkjepnfqdqarzaepszoaaqhruonbnnjfuqzpszlqzlzstbifjhihauuahujeldzldpqtvahaowxhzcavojiwltcplukzifxmrhzqwngdzlpycajltaeltggzszebfdswdfhmnjtqwwecvgnmgczrjrdvohuhjflelxspwqxkpinbgqfkjijxpxmhzglzewgftrtcaezloeksizxyobatxwlvmydxcalttrgkqcqsfeqrwhuoovygfqmnnidmomuojixwmalkvbqwywfhidifnydeitzxvjxigxavaoxkyacmlvsosiwulnejsuccpbjttyqklxgrwejtlesinnmfjpxsdqffxyxgbllrbzfyyorkrrajgkxbqbfsgmmdygwjagsvtwxehvtohiotxbiduasetcfwhnymcdkwummakvqnnmokzuhczkjnkbmsbfzygixuwhqyugowsodowtzezqwlubfuecqqlpzxaexujoaoqbjngxofhyfnywfabrxizldoaxmiyzzdeptmcwcqhslcowyavucgixvtyjwafxznjwxqyqvtvrxagpcyfdnwmmjimouvfyagxhdxdzjcmyzcttpnnzscmgkdlmjxhgwsvnazshvbwfoznqhanwhzdnzcdabtzcbshgadoagraarlypchoxiuivwxykguhimdcshwwdfjitquweewghqovciocxsromfcqaeykssiylagegbxffpzxbkhyfbqfncbcrkzldqnrvkvohupspdtcyvnidupgdeadtorkbcbmmxybvoldyowtnrrooqnwohryxdscczvfsrjgiiptasbtxbopryleuyavxcpdqunsjpcpdjrhejltyyveggvtswcltjoapagdsffqjoztgipiyjniejnvatkeonawgltcmiutyyitnqcfgvogwghnavzavlejyzgvdhqwzmqjgqznfeurncejtinazjgzmuwpvodoenwzcaavezqntmbwlwhbgfuijbmpdjmtvrnxhmfvundgxrlbynrleelqykjuwghlmvblfvpgfcbvfkzmsmxgcmoopmjfnbtmdoxczstcpvswnpjyskrizizvzvetzfjgwlpquqvzubdtcosdcypoiizdqtgizhkniydofrzdzzcugdlfpkcpbrltbqhpqppuxugoflroxnvqhccochlztvqrhfxcexfwravwwlmywqfthcwlgxfhksburxkiczpddumwyzktaknfjbvdjtolakqrqogdybzgwymmagjxzmepbbtpozdnryzjwestcujzuuepmoqwjvfjdjftrpzhlerbgbluvsbdbtsicferpywgrrciivjdznalidkmyatcgzbqwyayyjfltepkcnhvrqebbxdxxturxjlfmkckfcrrkpxpgvbjdmqowluuurgtrqjsgkkeevqlvykicvvbxipcuvuactcbbzhenonwlvkzjhoqqrvmuvuettvkapzcjeytkoqqgyfrfvqufvgqamtiynrgsfnogbqbhzjosovtuxzwhicmchvrccxgkkyhoqlhpmlfirxzdbkmicvogevcoriveqgbnwwbeajnhnuzmzyxvsoezphubbomiydjsuurwznqhjzuvgiaemljpyrmchgpgthqgyuposuziwlqyyohrvpjhwssmbzcyzdcftxxxdjjgnmnvyiszkcbacxntddcmdjazvaaiqzadjxuvbwpzbxzprkujueeavsodzfoeoiefcxknwzhxnniflytiwcvazloyfonbgzokgkrvmaymjuivnjcjgsfhbfrxzldgkuvzakbhqlqmxpsffpbjvpyoazzdpwmdhnapvdygwxfytkswhnakeklqvepfnkbwqylsoozlwohexeabdremeoawtrmespicxbrxjcqwoaoenqjehqtfuhgtssckblvujtjijwlamedrhwcztuolqdopkqiaszaamfpcpchlzpalxpiqejltzqiwxxrpsspdjhqnfloyrfmzanpznotamwqvlroqqmgzkvhozhrtbgqzfwhlkufoxfxgoigmsvopbhyohdqnnxdrvdmsonncfreytqstvjlqfqngxdctkjjlrylpfhlrezmynalafnvafkhjqogntheyjvalboggxsptuximtahiwbozaqeufajftodzaonuxgwjgmrbatxcrqqkympymjqfjbupqegtubacezwjacstfrdfpvcmxkgulsereiilfhtqdklyvxtfpvnajkgghsbiknlpojrngbfqjcghngganfypykoayacaqvsumcarocymhxijbxneydzxeuuugnraktfqychsdslvbjzjwqxmxmjqyyrrkbkpnahswaffqyskhvkcugxmbxanokmnqdekdqcumuiiklyinswkryvsppkzsixpjmreuhslmvzopudltnjlpsywpnfomlxrdpvrmsfiuqzblmrfzgjjnrybyeqwbihhfbfaupngbvusgakqbrtvxtlciycbjjmlvrpqkvdajahfibxcqrqrdamwwvecxiengzpeocpfjikkasenfhjqtiovwlvvscniserhjxctesfkekcgqbuwffggblahqodwjigxrgdfnfdquogzikfwtaedbtccjesivxkihrrcumeezqulggrsracrprfgyudndbjtpfqbooewtjzwkxyueebjnfwdwtmlgdapgxsvukmerllyyrapmhefyaycwulhozukmzcftkbpktzqsaqttwvovcnhnxvdftmztuhgspbvztvawsjrzbxrldotqhwoidzazayyobnirxknecdrtivocgogkqsedaiqyfuetkysrcihrujmytvdtlpwmfxkkxjyfczlvpteucatiqfuwsnuqnjfgphurguntjobtrsdiibbjpuqclsuaqhfeehrrdcjkvzktlwrltrkllrgymhffrnqohtabdyiaffhkpbjnhbwqnlqpfkoncyfcndtgrfjznnypxbaisoayajbzwzhhsmnfldbyfaxpqojljzrnwimfrieyrluosujlxfctovqdcbhkexrhprxvssltjpvvyhoswoojjrlqnpmuninvrkmmwrkivjyktnnkfuhrmycblchvicvsqnbwnbqicjradyerqmjzbzkzjsvsucclqvaspcbqdoeyapbybdpytmmezkjnozhweggfofmseagzdajavlqssayjnqsrlgnswkegiaychjsjwbjdwqsnxchvmlfvtwmkxcvfbyxjfrvfyczeggpgmzyddkolkfxyehyltbzunwvlqstzulaauonqapxkwtftgehbqrbhhfpxhmszycfwbwlaoumqyagcspabyhpvakdcysmvgiszqbiqllehprfuubexiwqjotrwldbyzxjqnynfnqjvosrruahgrqozisbtjtfjibnpeodsnsiklyltxwluuypgmffalwpahuzdxtmztqccvothfcolnzwcavwsnmnytrufgyyarokafsknivcrol 1000000';
var_dump(letterSwapping(...explode(' ', $input)));
