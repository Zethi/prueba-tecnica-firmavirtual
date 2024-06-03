import { FieldTypesEnum } from "@/types/enums/backend/filters/FieldTypesEnum";
import { OrderByEnum } from "@/types/enums/backend/filters/OrderByEnum";
import { Filters } from "@/types/interfaces/backend/filters/PokemonFilters";

interface Props {
    filters: Filters;
    setFilters: Function;
    getAllPokemonWithFilters: Function;
    children: React.ReactNode;
    field: FieldTypesEnum;
}


export function FieldsFilter({ children, setFilters, filters, field, getAllPokemonWithFilters }: Props) {

    const value = filters.fields!.find(fieldElement => fieldElement.name == field)?.order ?? "none";

    const handleChange = (event: React.ChangeEvent<HTMLSelectElement>) => {
        const value = event.target.value;
        const orderBy = OrderByEnum[value.toUpperCase() as keyof typeof OrderByEnum];
        let newFilters = { ...filters }
        if (value === 'none') {
            newFilters.fields = newFilters.fields?.filter((fieldElement) => fieldElement.name !== field)
        } else {
            newFilters.fields = [...filters.fields!, { name: field, order: orderBy }];
        }
        setFilters(newFilters);
        getAllPokemonWithFilters(newFilters);
    };

    return (
        <div className="flex flex-row gap-x-1">
            <label>{children}</label>
            <select onChange={handleChange} value={value}>
                <option value="none">None</option>
                <option value="asc">Asc</option>
                <option value="desc">Desc</option>
            </select>
        </div>
    );
}