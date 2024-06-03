import Image from "next/image";
import PokemonInfoSection from "@/components/sections/pokemon/PokemonInfoSection";
import { PokemonService } from "@/services/backend/v1/PokemonService";
import { addLeadingZeros } from "@/utils/StringUtils";
import { redirect } from "next/navigation";

interface Props {
    params: { pokemon: string }
}

export default async function Pokemon({ params }: Props) {
    let pokemon = undefined;

    try {
        pokemon = await (new PokemonService().getByIdentifier(params.pokemon));
    } catch (exception) {
        redirect('/')
    }
    
    return (
        <main className="h-full">

            <div className="grid grid-cols-2 h-full">
                <div className="items-center justify-center h-full hidden lg:flex">
                    <div>
                        <Image alt="pokemon-image" src={`https://raw.githubusercontent.com/HybridShivam/Pokemon/master/assets/images/${addLeadingZeros(pokemon.game_id)}.png`} width={600} height={600} />
                    </div>

                </div>
                <div className="flex justify-center my-24 col-span-2 lg:col-span-1">


                    <PokemonInfoSection pokemon={pokemon} />
                </div>

            </div>
        </main>
    );
}
