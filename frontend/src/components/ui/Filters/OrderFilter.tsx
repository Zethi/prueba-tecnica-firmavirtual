import { Select } from "../Select/Select"

export function OrderFilter() {
    return (
        <div className="flex flex-row items-center w-24 hover:text-gray-300">
            <span className="font-medium "> By</span>
            <Select onChange={() => { }} options={[{ label: 'Number', value: 'Number' }, { label: 'Type', value: 'Type' }]} defaultValue="Number" />
        </div>
    )

}