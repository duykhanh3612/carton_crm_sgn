    <div style="width:100%">


            <div class="form-group2 col-md-6 section_e section_slider_title">

                <textarea class="form-control row_title item" style="max-height:70px !important; width:100%">{{@$d->title}}</textarea>

            </div>
            <div class="form-group2  col-md-6 section_e section_slider_content">
                <textarea class="form-control row_content item" style="max-height:70px !important; width:100%">{{    @ $d->content}}</textarea>
            </div>

            <div class="form-group2  col-md-4 section_e section_slider_image">
                <label for="upload{{$item_image}}" class="lable_upload">
                    <input class="form-control row_image item" value="{{@$d->image}}" type="hidden" />
                    <div id="thumb_upload{{$item_image}}" class="thumb-output">
                        @if(@$d->image!='')
                        <img src="{{    url($base.@$d->image)}}" />
                        @else
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAANlBMVEX///+/v7+8vLzKysr8/Pzg4ODFxcXb29vT09Pj4+P4+PjBwcH6+vry8vLY2NjIyMjp6eno6Og1AQOEAAAEdUlEQVR4nO2d6ZbCIAxGp3TT1i6+/8uOWrUUwlKsIZ7z3d+dwh0wIYDHvz8AAAAAAAAAAAAAAAAAXqqx+Snq/YYnVfwQqoUhDKUDQxjKB4YwlA8MYSifAwyVNA43PJ2FUR5sqM673/BljP7B0AaG2YFhEBhmB4ZBYJgdGAaBYXZgGASG2YFhEBhmB4ZBYJidDIaXKqWjyfAaXubxsUs7nbvkHu+F1XAuX1vQqmm5RpLTsO61R9WJaRgZDc0Djmb4pOPR8BmezTMqVX7U81jYDIemMFH775glwGY4EseMH8zTNvpPuQw7ewhvJC8Phn6MfZTLcKZOitUpMWXcGp1iQzGXITVJiyK6mwatih9/LkP6tL9PM+zUjvH/ScPlZZGxJq9hk2RYP96lTnFPcxnWpGF52d2ellnjHucyHMhYGh3ydcrX6v0a9TiX4WV76WOhn3c3p8+GMirWsK1pztQkTUiH2uov7h/EZliV1jxVCYu26rS3t3y1xaU3DVMW3puIFRWKGevDudmOYkqV3xWRja1w1viDNlFV2qackVab3X/y7Z2oc9k8dqL6aUzJhH+1Mc9jPsnMu4nVULfjWF/TVmtWFR2TUH9qR9gOxxHFiTDD2Rd9qJVfOB7LMuzU6FYkdnpiVrayDG/vclYMeq7XCMYaUYb3lZ2zsqWrk3ANJcmwmx6voCfqNtdrDYbWDZIMX3s55LC4vvQQbFCQ4buEpMKNmetXQgWKHEO9grQUyTi6EKqh5BhuCkhzrWLn+rXFwLpGjOHQb7u9GUXrVGcziP6EIcbQHCW9tvLM0SJ4wCPF0N71XyefI9e/8ddQQgyJg5v180Xneu1Jb6wRYthSPX92xpXr1za96xoZhoO1h6MpunL9ivccktuwIgu6yTE49+64c/36nC/WcBteS0LRnQzaQBx94quhuHcxSmX3pnMM4Z06PEcL/34Ns+Ft4aJ6Q9H7TeIYvxueax3Mt77ua09lTNQ5TsKLck9TXsNnXt8qxnzQgobuWMNr+EwKSj/7bSMnop/JOYishtd3BVi+Q0NUrAzTOw8TOQ0rrQJ8TdTQmjMW98UFTkO9AnxNVG9dtAdnDcVouD0GVtO9SxW9XEvA2XXO0zVjuO478seEmQd9fkN7uLr5sCF0X1zgM7zawzVR1xeSDR01FOM5/oE2JI4aKutdjGNxdD7rfZqDoQ8Ts94vPRh6v4bL8MCg6WbKaEgE0i+gqGnKY/j9QOruPo/h9wPpAnVJisWQI5AuEK2zGHIE0qV1ooZiMWQJpAv2uobDkCeQLs3bh4kMhkyB9EkOw8PK+Bjs9r9vWI0lJ9Y0ZRjDjhVrV1HG6do3gWEQGGYHhkFgmB0YBoFhdmAYBIbZOdqwqCtZHG/YsFaDEWw3ifDbCDCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUT5rhT5FgONc/Bc/PuwIAAAAAAAAAAAAAAAAQzD8O4oElgraltwAAAABJRU5ErkJggg==" />

                        @endif
                    </div>
                    <input type="file" id="upload{{$item_image}}" data-id="#thumb_upload{{    $item_image}}" style="display:none" class="add-file-upload" />
                </label>
                <label><em>Hình ảnh</em> </label>
            </div>
            <div class="form-group2  col-md-4 section_e section_slider_icon">
                <label for="upload_icon{{$item_image}}" class="lable_upload_icon">
                    <input class="form-control row_icon item" value="{{@$d->icon}}" type="hidden" />
                    <div id="thumb_upload_icon{{$item_image}}" class="thumb-output_icon">
                        @if(@$d->icon!='')
                        <img src="{{url($base.@$d->icon)}}" />
                        @else
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAANlBMVEX///+/v7+8vLzKysr8/Pzg4ODFxcXb29vT09Pj4+P4+PjBwcH6+vry8vLY2NjIyMjp6eno6Og1AQOEAAAEdUlEQVR4nO2d6ZbCIAxGp3TT1i6+/8uOWrUUwlKsIZ7z3d+dwh0wIYDHvz8AAAAAAAAAAAAAAAAAXqqx+Snq/YYnVfwQqoUhDKUDQxjKB4YwlA8MYSifAwyVNA43PJ2FUR5sqM673/BljP7B0AaG2YFhEBhmB4ZBYJgdGAaBYXZgGASG2YFhEBhmB4ZBYJidDIaXKqWjyfAaXubxsUs7nbvkHu+F1XAuX1vQqmm5RpLTsO61R9WJaRgZDc0Djmb4pOPR8BmezTMqVX7U81jYDIemMFH775glwGY4EseMH8zTNvpPuQw7ewhvJC8Phn6MfZTLcKZOitUpMWXcGp1iQzGXITVJiyK6mwatih9/LkP6tL9PM+zUjvH/ScPlZZGxJq9hk2RYP96lTnFPcxnWpGF52d2ellnjHucyHMhYGh3ydcrX6v0a9TiX4WV76WOhn3c3p8+GMirWsK1pztQkTUiH2uov7h/EZliV1jxVCYu26rS3t3y1xaU3DVMW3puIFRWKGevDudmOYkqV3xWRja1w1viDNlFV2qackVab3X/y7Z2oc9k8dqL6aUzJhH+1Mc9jPsnMu4nVULfjWF/TVmtWFR2TUH9qR9gOxxHFiTDD2Rd9qJVfOB7LMuzU6FYkdnpiVrayDG/vclYMeq7XCMYaUYb3lZ2zsqWrk3ANJcmwmx6voCfqNtdrDYbWDZIMX3s55LC4vvQQbFCQ4buEpMKNmetXQgWKHEO9grQUyTi6EKqh5BhuCkhzrWLn+rXFwLpGjOHQb7u9GUXrVGcziP6EIcbQHCW9tvLM0SJ4wCPF0N71XyefI9e/8ddQQgyJg5v180Xneu1Jb6wRYthSPX92xpXr1za96xoZhoO1h6MpunL9ivccktuwIgu6yTE49+64c/36nC/WcBteS0LRnQzaQBx94quhuHcxSmX3pnMM4Z06PEcL/34Ns+Ft4aJ6Q9H7TeIYvxueax3Mt77ua09lTNQ5TsKLck9TXsNnXt8qxnzQgobuWMNr+EwKSj/7bSMnop/JOYishtd3BVi+Q0NUrAzTOw8TOQ0rrQJ8TdTQmjMW98UFTkO9AnxNVG9dtAdnDcVouD0GVtO9SxW9XEvA2XXO0zVjuO478seEmQd9fkN7uLr5sCF0X1zgM7zawzVR1xeSDR01FOM5/oE2JI4aKutdjGNxdD7rfZqDoQ8Ts94vPRh6v4bL8MCg6WbKaEgE0i+gqGnKY/j9QOruPo/h9wPpAnVJisWQI5AuEK2zGHIE0qV1ooZiMWQJpAv2uobDkCeQLs3bh4kMhkyB9EkOw8PK+Bjs9r9vWI0lJ9Y0ZRjDjhVrV1HG6do3gWEQGGYHhkFgmB0YBoFhdmAYBIbZOdqwqCtZHG/YsFaDEWw3ifDbCDCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUT5rhT5FgONc/Bc/PuwIAAAAAAAAAAAAAAAAQzD8O4oElgraltwAAAABJRU5ErkJggg==" />

                        @endif
                    </div>
                    <input type="file" id="upload_icon{{$item_image}}" data-id="#thumb_upload_icon{{    $item_image}}" style="display:none" class="add-file-upload_icon" />
                </label>
                <label><em>Icon</em> </label>
            </div>
            <div class="form-group2  col-md-4 section_e section_slider_icon_2">
                <label for="upload_icon_2{{$item_image}}" class="lable_upload_icon">
                    <input class="form-control row_icon_2 item" value="{{@$d->icon2}}" type="hidden" />
                    <div id="thumb_upload_icon_2{{$item_image}}" class="thumb-output_icon">
                        @if(@$d->icon2!='')
                        <img src="{{url($base.@$d->icon2)}}" />
                        @else
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAANlBMVEX///+/v7+8vLzKysr8/Pzg4ODFxcXb29vT09Pj4+P4+PjBwcH6+vry8vLY2NjIyMjp6eno6Og1AQOEAAAEdUlEQVR4nO2d6ZbCIAxGp3TT1i6+/8uOWrUUwlKsIZ7z3d+dwh0wIYDHvz8AAAAAAAAAAAAAAAAAXqqx+Snq/YYnVfwQqoUhDKUDQxjKB4YwlA8MYSifAwyVNA43PJ2FUR5sqM673/BljP7B0AaG2YFhEBhmB4ZBYJgdGAaBYXZgGASG2YFhEBhmB4ZBYJidDIaXKqWjyfAaXubxsUs7nbvkHu+F1XAuX1vQqmm5RpLTsO61R9WJaRgZDc0Djmb4pOPR8BmezTMqVX7U81jYDIemMFH775glwGY4EseMH8zTNvpPuQw7ewhvJC8Phn6MfZTLcKZOitUpMWXcGp1iQzGXITVJiyK6mwatih9/LkP6tL9PM+zUjvH/ScPlZZGxJq9hk2RYP96lTnFPcxnWpGF52d2ellnjHucyHMhYGh3ydcrX6v0a9TiX4WV76WOhn3c3p8+GMirWsK1pztQkTUiH2uov7h/EZliV1jxVCYu26rS3t3y1xaU3DVMW3puIFRWKGevDudmOYkqV3xWRja1w1viDNlFV2qackVab3X/y7Z2oc9k8dqL6aUzJhH+1Mc9jPsnMu4nVULfjWF/TVmtWFR2TUH9qR9gOxxHFiTDD2Rd9qJVfOB7LMuzU6FYkdnpiVrayDG/vclYMeq7XCMYaUYb3lZ2zsqWrk3ANJcmwmx6voCfqNtdrDYbWDZIMX3s55LC4vvQQbFCQ4buEpMKNmetXQgWKHEO9grQUyTi6EKqh5BhuCkhzrWLn+rXFwLpGjOHQb7u9GUXrVGcziP6EIcbQHCW9tvLM0SJ4wCPF0N71XyefI9e/8ddQQgyJg5v180Xneu1Jb6wRYthSPX92xpXr1za96xoZhoO1h6MpunL9ivccktuwIgu6yTE49+64c/36nC/WcBteS0LRnQzaQBx94quhuHcxSmX3pnMM4Z06PEcL/34Ns+Ft4aJ6Q9H7TeIYvxueax3Mt77ua09lTNQ5TsKLck9TXsNnXt8qxnzQgobuWMNr+EwKSj/7bSMnop/JOYishtd3BVi+Q0NUrAzTOw8TOQ0rrQJ8TdTQmjMW98UFTkO9AnxNVG9dtAdnDcVouD0GVtO9SxW9XEvA2XXO0zVjuO478seEmQd9fkN7uLr5sCF0X1zgM7zawzVR1xeSDR01FOM5/oE2JI4aKutdjGNxdD7rfZqDoQ8Ts94vPRh6v4bL8MCg6WbKaEgE0i+gqGnKY/j9QOruPo/h9wPpAnVJisWQI5AuEK2zGHIE0qV1ooZiMWQJpAv2uobDkCeQLs3bh4kMhkyB9EkOw8PK+Bjs9r9vWI0lJ9Y0ZRjDjhVrV1HG6do3gWEQGGYHhkFgmB0YBoFhdmAYBIbZOdqwqCtZHG/YsFaDEWw3ifDbCDCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUT5rhT5FgONc/Bc/PuwIAAAAAAAAAAAAAAAAQzD8O4oElgraltwAAAABJRU5ErkJggg==" />

                        @endif
                    </div>
                    <input type="file" id="upload_icon_2{{$item_image}}" data-id="#thumb_upload_icon_2{{    $item_image}}" style="display:none" class="add-file-upload_icon_2" />
                </label>
                <label><em>Icon 2</em> </label>
            </div>

        <div style="display:none">   
        
        </div>
    </div>
