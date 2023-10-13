<x-mail::message>

# New Contact added  

<x-mail::table>
| Data          |               |
| ------------- |:-------------:|
| ID:           | {{$contact->id}}|
| Name:         | {{$contact->name}}| 
| Email:        | {{$contact->email}}|
</x-mail::table>

</x-mail::message>
